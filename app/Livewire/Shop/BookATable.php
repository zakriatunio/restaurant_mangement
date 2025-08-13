<?php

namespace App\Livewire\Shop;

use App\Events\ReservationReceived;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Reservation;
use App\Models\ReservationSetting;
use App\Models\Table;
use App\Notifications\ReservationConfirmation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class BookATable extends Component
{
    use LivewireAlert;

    protected $listeners = ['setCustomer' => '$refresh'];

    public $reservationSettings;
    public $date;
    public $period;
    public $numberOfGuests;
    public $slotType;
    public $specialRequest;
    public $restaurant;
    public $availableTimeSlots = [];
    public $shopBranch;
    public $tables = [];
    public $reservations;
    public $selectedTable = null;
    public $showTableModal = false;
    public $viewingTable = null;
    public $showPicturesModal = false;
    public $selectedTablePictures = null;
    
    // Payment related properties
    public $showPaymentModal = false;
    public $advancePaymentAmount = 0;
    public $paymentMethod = '';
    public $availablePaymentMethods = [];
    public $paymentGatewayCredentials = null;
    public $processingPayment = false;

    // Time slot options (empty until date and slot type are selected)
    public $timeSlots = [];

    public function mount()
    {
        if (!$this->restaurant) {
            return $this->redirect(route('home'));
        }

        $startOfWeek = now();
        $endOfWeek = now()->addDays(6);

        $period = CarbonPeriod::create($startOfWeek, $endOfWeek); // Create a period for the week

        $this->date = $period->copy()->first()->format('Y-m-d');

        $hour = now()->format('H');
        $minute = now()->format('i');
        $currentTime = intval($hour) * 60 + intval($minute); // Convert to minutes for better comparison

        // More accurate time slot determination
        if ($currentTime >= 17 * 60) { // 17:00 and later
            $dayTerm = 'Dinner';
        } elseif ($currentTime >= 11 * 60) { // 11:00 and later (past breakfast)
            $dayTerm = 'Lunch';
        } else {
            $dayTerm = 'Breakfast';
        }

        $this->slotType = $dayTerm;
        $this->numberOfGuests = 1;

        if (request()->branch && request()->branch != '') {
            $this->shopBranch = Branch::find(request()->branch);
        } else {
            $this->shopBranch = $this->restaurant->branches->first();
        }

        $this->loadAvailableTimeSlots();
        $this->loadTables();
        $this->loadPaymentSettings();
    }

    public function updatedAvailableTimeSlots($value)
    {
        $this->loadTables();
    }

    public function setReservationDate($selectedDate)
    {
        $this->date = $selectedDate;
        $this->loadAvailableTimeSlots();
        $this->loadTables();
    }

    public function setReservationGuest($noOfGuests)
    {
        $this->numberOfGuests = $noOfGuests;
        $this->loadTables();
    }

    public function setReservationSlotType($type)
    {
        $this->slotType = $type;
        $this->loadAvailableTimeSlots();
        $this->loadTables();
    }

    public function selectTable($tableId)
    {
        // Check if table is reserved
        if ($this->isTableReserved($tableId)) {
            $this->alert('error', __('messages.tableAlreadyReserved'), [
                'toast' => true,
                'position' => 'top-end',
                'showCancelButton' => false,
                'timer' => 3000
            ]);
            return;
        }

        $table = Table::find($tableId);
        
        // Check if table is active
        if (!$table || $table->status !== 'active') {
            $this->alert('error', __('messages.tableNotAvailable'), [
                'toast' => true,
                'position' => 'top-end',
                'showCancelButton' => false,
                'timer' => 3000
            ]);
            return;
        }

        $this->selectedTable = $table;
        $this->showTableModal = true;
    }

    public function viewTable($tableId)
    {
        $this->viewingTable = Table::with('area')->find($tableId);
        $this->showPicturesModal = true;
    }

    public function confirmTableSelection()
    {
        if (!$this->selectedTable) {
            return;
        }

        $this->showTableModal = false;
        $this->alert('success', __('messages.tableSelected'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'cancelButtonText' => __('app.close')
        ]);
    }

    public function loadTables()
    {
        Log::info('Loading tables for:', [
            'date' => $this->date,
            'time' => $this->availableTimeSlots,
            'timeSlots' => $this->timeSlots,
            'guests' => $this->numberOfGuests,
            'branch_id' => $this->shopBranch->id ?? null
        ]);

        if (empty($this->date) || !$this->shopBranch) {
            Log::info('Date or branch is empty');
            $this->tables = collect();
            return;
        }

        // Show tables even if no time slot is selected yet (for initial load)
        if (empty($this->availableTimeSlots) && empty($this->timeSlots)) {
            Log::info('No time slots available, but showing tables for selection');
        }

        // Load areas with tables filtered by branch
        $this->tables = Area::with(['tables' => function ($query) {
            $query->where('branch_id', $this->shopBranch->id)
                ->where('seating_capacity', '>=', $this->numberOfGuests);
        }])
            ->whereHas('tables', function ($query) {
                $query->where('branch_id', $this->shopBranch->id);
            })
            ->get();

        // Get confirmed reservations for the selected date and time
        if ($this->date && !empty($this->availableTimeSlots)) {
            $this->reservations = Reservation::where('branch_id', $this->shopBranch->id)
                ->whereDate('reservation_date_time', $this->date)
                ->whereTime('reservation_date_time', $this->availableTimeSlots)
                ->where('reservation_status', 'Confirmed')
                ->whereNotNull('table_id')
                ->get();
        } else {
            // Also load reservations for the entire day to show reserved tables even without time slot selection
            $this->reservations = Reservation::where('branch_id', $this->shopBranch->id)
                ->whereDate('reservation_date_time', $this->date)
                ->where('reservation_status', 'Confirmed')
                ->whereNotNull('table_id')
                ->get();
        }

        // Debug information
        Log::info('Tables loaded:', [
            'date' => $this->date,
            'time' => $this->availableTimeSlots,
            'guests' => $this->numberOfGuests,
            'branch_id' => $this->shopBranch->id,
            'areas_count' => $this->tables->count(),
            'tables_count' => $this->tables->sum(function ($area) {
                return $area->tables->count();
            }),
            'reservations_count' => $this->reservations->count()
        ]);
    }

    public function loadAvailableTimeSlots()
    {
        Log::info('Loading time slots for:', [
            'date' => $this->date,
            'slotType' => $this->slotType,
            'branch_id' => $this->shopBranch->id ?? null
        ]);

        if ($this->date && $this->slotType && $this->shopBranch) {
            $dayOfWeek = Carbon::parse($this->date)->format('l');
            $currentTime = Carbon::now()->format('H:i:s');
            $selectedDate = Carbon::parse($this->date)->format('Y-m-d');

            // Fetch available slots for the selected day of the week and slot type
            $settings = ReservationSetting::where('day_of_week', $dayOfWeek)
                ->where('slot_type', $this->slotType)
                ->where('available', 1)
                ->where('branch_id', $this->shopBranch->id)
                ->first();

            Log::info('Reservation settings found:', [
                'settings_found' => $settings ? true : false,
                'dayOfWeek' => $dayOfWeek,
                'slotType' => $this->slotType,
                'branch_id' => $this->shopBranch->id
            ]);

            if ($settings) {
                // Generate time slots based on the time slot difference
                $startTime = Carbon::parse($settings->time_slot_start);
                $endTime = Carbon::parse($settings->time_slot_end);
                $slotDifference = (int)$settings->time_slot_difference;

                $this->timeSlots = [];

                while ($startTime->lte($endTime)) {
                    // Check if the selected date is today and if the slot is in the past
                    if ($selectedDate == Carbon::now()->format('Y-m-d') && $startTime->format('H:i:s') <= $currentTime) {
                        $startTime->addMinutes($slotDifference);
                        continue; // Skip past times
                    }

                    $this->timeSlots[] = $startTime->format('H:i:s');
                    $startTime->addMinutes($slotDifference);
                }

                Log::info('Time slots generated:', [
                    'timeSlots' => $this->timeSlots,
                    'count' => count($this->timeSlots)
                ]);
            } else {
                // No reservation settings found - create default time slots or show message
                $this->timeSlots = [];
                Log::info('No reservation settings found for this branch/day/slot combination');
            }
        }
    }



    public function isTableReserved($tableId)
    {
        return $this->reservations->contains('table_id', $tableId);
    }

    public function loadPaymentSettings()
    {
        if (!$this->shopBranch) {
            return;
        }

        // Load payment gateway credentials for the restaurant
        $this->paymentGatewayCredentials = \App\Models\PaymentGatewayCredential::where('restaurant_id', $this->restaurant->id)->first();
        
        // Set available payment methods based on configured gateways
        $this->availablePaymentMethods = [];
        
        if ($this->paymentGatewayCredentials) {
            if ($this->paymentGatewayCredentials->stripe_status) {
                $this->availablePaymentMethods[] = 'stripe';
            }
            if ($this->paymentGatewayCredentials->razorpay_status) {
                $this->availablePaymentMethods[] = 'razorpay';
            }
            if ($this->paymentGatewayCredentials->flutterwave_status) {
                $this->availablePaymentMethods[] = 'flutterwave';
            }
        }
        
        // Always allow cash payment option
        $this->availablePaymentMethods[] = 'cash';
        
        // Set default advance payment amount (you can make this configurable)
        $this->advancePaymentAmount = 50.00; // Default $50 advance payment
    }

    public function proceedToPayment()
    {
        Log::info('proceedToPayment called', [
            'selectedTable' => $this->selectedTable ? $this->selectedTable->id : null,
            'availableTimeSlots' => $this->availableTimeSlots,
            'advancePaymentAmount' => $this->advancePaymentAmount,
            'availablePaymentMethods' => $this->availablePaymentMethods
        ]);

        if (!$this->selectedTable) {
            $this->alert('error', 'Please select a table first', [
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3000
            ]);
            return;
        }

        if (empty($this->availableTimeSlots)) {
            $this->alert('error', 'Please select a time slot first', [
                'toast' => true,
                'position' => 'top-end',
                'timer' => 3000
            ]);
            return;
        }

        // Ensure payment settings are loaded
        if (empty($this->availablePaymentMethods)) {
            $this->loadPaymentSettings();
        }

        $this->showTableModal = false;

        // Try to show modal first
        $this->showPaymentModal = true;

        // If modal doesn't work, redirect to payment page as fallback
        // Store reservation data in session for the payment page
        session([
            'reservation_data' => [
                'table_id' => $this->selectedTable->id,
                'table_code' => $this->selectedTable->table_code,
                'date' => $this->date,
                'time' => $this->availableTimeSlots,
                'guests' => $this->numberOfGuests,
                'slot_type' => $this->slotType,
                'special_request' => $this->specialRequest,
                'branch_id' => $this->shopBranch->id,
                'advance_payment_amount' => $this->advancePaymentAmount
            ]
        ]);

        Log::info('Payment modal should be shown', [
            'showPaymentModal' => $this->showPaymentModal,
            'showTableModal' => $this->showTableModal
        ]);
    }

    public function redirectToPaymentPage()
    {
        // Store reservation data in session
        session([
            'reservation_data' => [
                'table_id' => $this->selectedTable->id,
                'table_code' => $this->selectedTable->table_code,
                'date' => $this->date,
                'time' => $this->availableTimeSlots,
                'guests' => $this->numberOfGuests,
                'slot_type' => $this->slotType,
                'special_request' => $this->specialRequest,
                'branch_id' => $this->shopBranch->id,
                'advance_payment_amount' => $this->advancePaymentAmount
            ]
        ]);

        return redirect()->route('reservation_payment', ['hash' => $this->restaurant->hash]);
    }

    public function processPayment()
    {
        $this->validate([
            'paymentMethod' => 'required|in:stripe,razorpay,flutterwave,cash',
            'advancePaymentAmount' => 'required|numeric|min:0'
        ]);

        $this->processingPayment = true;

        try {
            if ($this->paymentMethod === 'cash') {
                // Handle cash payment (no online processing needed)
                $this->createReservationWithPayment('cash', null, 'pending');
            } else {
                // Handle online payment gateways
                $this->processOnlinePayment();
            }
        } catch (\Exception $e) {
            $this->processingPayment = false;
            $this->alert('error', 'Payment processing failed: ' . $e->getMessage(), [
                'toast' => true,
                'position' => 'top-end',
                'timer' => 5000
            ]);
        }
    }

    private function processOnlinePayment()
    {
        // This is a simplified implementation
        // In a real application, you would integrate with actual payment gateways
        
        switch ($this->paymentMethod) {
            case 'stripe':
                $this->processStripePayment();
                break;
            case 'razorpay':
                $this->processRazorpayPayment();
                break;
            case 'flutterwave':
                $this->processFlutterwavePayment();
                break;
        }
    }

    private function processStripePayment()
    {
        // Simulate Stripe payment processing
        // In real implementation, you would use Stripe SDK
        $transactionId = 'stripe_' . uniqid();
        $this->createReservationWithPayment('stripe', $transactionId, 'paid');
    }

    private function processRazorpayPayment()
    {
        // Simulate Razorpay payment processing
        // In real implementation, you would use Razorpay SDK
        $transactionId = 'razorpay_' . uniqid();
        $this->createReservationWithPayment('razorpay', $transactionId, 'paid');
    }

    private function processFlutterwavePayment()
    {
        // Simulate Flutterwave payment processing
        // In real implementation, you would use Flutterwave SDK
        $transactionId = 'flutterwave_' . uniqid();
        $this->createReservationWithPayment('flutterwave', $transactionId, 'paid');
    }

    private function createReservationWithPayment($paymentMethod, $transactionId, $paymentStatus)
    {
        $defaultTableReservationStatus = $this->restaurant->default_table_reservation_status ?? 'Confirmed';

        $reservation = Reservation::create([
            'reservation_date_time' => $this->date . ' ' . $this->availableTimeSlots,
            'customer_id' => customer()->id,
            'branch_id' => $this->shopBranch->id,
            'table_id' => $this->selectedTable->id,
            'party_size' => $this->numberOfGuests,
            'reservation_slot_type' => $this->slotType,
            'reservation_status' => $defaultTableReservationStatus,
            'special_requests' => $this->specialRequest,
            // Payment fields
            'advance_payment_amount' => $this->advancePaymentAmount,
            'payment_status' => $paymentStatus,
            'payment_method' => $paymentMethod,
            'payment_transaction_id' => $transactionId,
            'payment_date' => $paymentStatus === 'paid' ? now() : null,
            'payment_details' => [
                'amount' => $this->advancePaymentAmount,
                'currency' => 'USD', // You can make this configurable
                'gateway' => $paymentMethod,
                'processed_at' => now()->toISOString()
            ]
        ]);

        try {
            customer()->notify(new ReservationConfirmation($reservation));
        } catch (\Exception $e) {
            Log::error('Error sending reservation confirmation email: ' . $e->getMessage());
        }

        ReservationReceived::dispatch($reservation);

        $this->processingPayment = false;
        $this->showPaymentModal = false;

        $message = $paymentMethod === 'cash' 
            ? 'Reservation confirmed! Please pay the advance amount at the restaurant.'
            : 'Payment successful! Your table reservation is confirmed.';

        $this->alert('success', $message, [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'timer' => 5000
        ]);

        return redirect()->route('my_bookings', ['hash' => $this->restaurant->hash, 'branch' => $this->shopBranch->id]);
    }

    public function testPaymentModal()
    {
        Log::info('testPaymentModal called');
        
        // Set some test data
        if (!$this->selectedTable && !empty($this->tables)) {
            $firstArea = $this->tables->first();
            if ($firstArea && $firstArea->tables->count() > 0) {
                $this->selectedTable = $firstArea->tables->first();
            }
        }
        
        if (empty($this->availableTimeSlots) && !empty($this->timeSlots)) {
            $this->availableTimeSlots = $this->timeSlots[0];
        }
        
        $this->loadPaymentSettings();
        $this->showPaymentModal = true;
        
        Log::info('Test modal state:', [
            'showPaymentModal' => $this->showPaymentModal,
            'selectedTable' => $this->selectedTable ? $this->selectedTable->id : null,
            'availablePaymentMethods' => $this->availablePaymentMethods,
            'paymentMethod' => $this->paymentMethod,
            'advancePaymentAmount' => $this->advancePaymentAmount
        ]);
        
        // Show an alert to confirm
        $this->alert('info', 'Test modal triggered! Check if modal appears.', [
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000
        ]);
    }

    public function forceShowModal()
    {
        Log::info('forceShowModal called - bypassing all conditions');
        
        // Force show modal regardless of conditions
        $this->showPaymentModal = true;
        
        // Ensure we have payment methods
        if (empty($this->availablePaymentMethods)) {
            $this->availablePaymentMethods = ['cash', 'stripe'];
        }
        
        // Set default payment method
        if (empty($this->paymentMethod)) {
            $this->paymentMethod = 'cash';
        }
        
        Log::info('Force modal state:', [
            'showPaymentModal' => $this->showPaymentModal,
            'availablePaymentMethods' => $this->availablePaymentMethods,
            'paymentMethod' => $this->paymentMethod
        ]);
        
        $this->alert('success', 'Modal forced to show! Should be visible now.', [
            'toast' => true,
            'position' => 'top-end',
            'timer' => 3000
        ]);
    }

    public function simpleModalTest()
    {
        Log::info('simpleModalTest called');
        
        // Just toggle the modal state
        $this->showPaymentModal = !$this->showPaymentModal;
        
        // Force a complete re-render
        $this->dispatch('$refresh');
        
        Log::info('Simple modal test:', [
            'showPaymentModal' => $this->showPaymentModal
        ]);
    }

    public function forceModalTrue()
    {
        Log::info('forceModalTrue called');
        
        // Explicitly set to true and force refresh
        $this->showPaymentModal = true;
        $this->availablePaymentMethods = ['cash', 'stripe'];
        $this->paymentMethod = 'cash';
        
        // Force multiple refresh attempts
        $this->dispatch('$refresh');
        $this->skipRender = false;
        
        Log::info('Force modal true state:', [
            'showPaymentModal' => $this->showPaymentModal,
            'availablePaymentMethods' => $this->availablePaymentMethods
        ]);
    }

    public function debugState()
    {
        Log::info('Current component state:', [
            'showPaymentModal' => $this->showPaymentModal,
            'showTableModal' => $this->showTableModal,
            'selectedTable' => $this->selectedTable ? $this->selectedTable->toArray() : null,
            'availableTimeSlots' => $this->availableTimeSlots,
            'paymentMethod' => $this->paymentMethod,
            'availablePaymentMethods' => $this->availablePaymentMethods,
            'advancePaymentAmount' => $this->advancePaymentAmount,
            'timeSlots' => $this->timeSlots,
            'date' => $this->date,
            'slotType' => $this->slotType,
            'numberOfGuests' => $this->numberOfGuests
        ]);
        
        $this->alert('info', 'Debug info logged. Check Laravel logs.', [
            'toast' => true,
            'position' => 'top-end',
            'timer' => 2000
        ]);
    }

    public function openPanoramaViewer($tableId)
    {
        $table = Table::find($tableId);
        if ($table) {
            $url = route('table_panorama', ['hash' => $table->hash]);
            $this->dispatch('open-panorama-viewer', url: $url);
        }
    }

    public function render()
    {
        Log::info('BookATable render() called', [
            'showPaymentModal' => $this->showPaymentModal,
            'selectedTable' => $this->selectedTable ? $this->selectedTable->id : null,
            'tables_count' => $this->tables->count(),
            'restaurant' => $this->restaurant ? $this->restaurant->name : null
        ]);

        return view('livewire.shop.book-a-table', [
            'tables' => $this->tables
        ]);
    }
}
