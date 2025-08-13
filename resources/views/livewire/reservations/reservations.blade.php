<div>

    @assets
    <script src="{{ asset('vendor/pikaday.js') }}" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/pikaday.css') }}">
    @endassets

    <div class="p-4 bg-white block dark:bg-gray-800 dark:border-gray-700">
        <!-- Header Section -->
        <div class="w-full mb-4">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">@lang('menu.reservations')</h1>
        </div>

        <!-- Filters Section -->
        <div class="items-center justify-between block sm:flex bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
            <div class="flex flex-col sm:flex-row gap-4 w-full">
                <!-- Date Range Filters -->
                <div class="flex flex-col sm:flex-row gap-4 flex-grow">
                    <x-select id="dateRangeType" class="block w-full sm:w-48" wire:model="dateRangeType" wire:change="setDateRange">
                            <option value="today">@lang('app.today')</option>
                            <option value="nextWeek">@lang('app.nextWeek')</option>
                            <option value="currentWeek">@lang('app.currentWeek')</option>
                            <option value="lastWeek">@lang('app.lastWeek')</option>
                            <option value="last7Days">@lang('app.last7Days')</option>
                            <option value="currentMonth">@lang('app.currentMonth')</option>
                            <option value="lastMonth">@lang('app.lastMonth')</option>
                            <option value="currentYear">@lang('app.currentYear')</option>
                            <option value="lastYear">@lang('app.lastYear')</option>
                        </x-select>

                    <div id="date-range-picker" date-rangepicker class="flex items-center gap-2 flex-grow">
                        <div class="relative flex-grow">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-start" name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model.change='startDate' placeholder="@lang('app.selectStartDate')">
                            </div>
                        <span class="text-gray-500">@lang('app.to')</span>
                        <div class="relative flex-grow">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-end" name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    wire:model.live='endDate' placeholder="@lang('app.selectEndDate')">
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="w-full sm:w-64">
                    <x-input class="block w-full" type="text" wire:model.live.debounce.400ms="search" 
                        placeholder="{{ __('placeholders.searchCustomers') }}" />
            </div>

                <!-- New Reservation Button -->
            @if(user_can('Create Reservation') && in_array('Table Reservation', restaurant_modules()))
                    <div class="w-full sm:w-auto">
                        <x-button type='button' wire:click="$set('showAddReservation', true)" class="w-full">
                            @lang('modules.reservation.newReservation')
                        </x-button>
                    </div>
            @endif
            </div>
        </div>

        <!-- Reservations Grid -->
        <div class="flex flex-col my-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse ($reservations as $item)
                    @livewire('reservations.reservation-card', ['reservation' => $item], key('reservation-' . $item->id . microtime()))
                    @empty
                    <div class="col-span-full">
                        <div class="flex flex-col items-center justify-center p-8 bg-gray-50 rounded-lg dark:bg-gray-700">
                            <svg class="w-16 h-16 text-gray-400 mb-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 4H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm-3-2v4M8 2v4m-5 4h18m-7 4h-4v4h4v-4z"/>
                            </svg>
                            <p class="text-lg font-medium text-gray-600 dark:text-gray-400">@lang('messages.noReservationsFound')</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
    </div>

    <!-- New Reservation Modal -->
    <x-right-modal wire:model.live="showAddReservation">
        <x-slot name="title">
            {{ __("modules.reservation.newReservation") }}
        </x-slot>

        <x-slot name="content">
            @livewire('forms.newReservation')
        </x-slot>
    </x-right-modal>

    @script
    <script>
        const datepickerEl1 = document.getElementById('datepicker-range-start');
        datepickerEl1.addEventListener('changeDate', (event) => {
            $wire.dispatch('setStartDate', { start: datepickerEl1.value });
        });

        const datepickerEl2 = document.getElementById('datepicker-range-end');
        datepickerEl2.addEventListener('changeDate', (event) => {
            $wire.dispatch('setEndDate', { end: datepickerEl2.value });
        });
    </script>
    @endscript

</div>
