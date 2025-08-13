<div>
    <!-- Debug: Livewire Component Loading Test -->
    <div style="background: lime; padding: 10px; margin: 10px; border: 2px solid green;">
        <h3>🟢 LIVEWIRE COMPONENT LOADED!</h3>
        <p>Component: BookATable</p>
        <p>Restaurant: {{ $restaurant->name ?? 'Not set' }}</p>
        <p>Show Payment Modal: {{ $showPaymentModal ? 'TRUE' : 'FALSE' }}</p>
    </div>

    <section class="bg-white dark:bg-gray-900 hidden lg:block px-4">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12 bg-skin-base/[.1] dark:bg-gray-800 rounded-lg">
            <h1 class="text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-3xl dark:text-white">@lang('messages.frontReservationHeading')</h1>
        </div>
    </section>

    <div class="space-y-8 max-w-6xl mx-auto lg:mt-20 p-4">
        <h4 class="text-2xl font-bold dark:text-white">@lang('messages.selectBookingDetail')</h4>

        <div class="grid lg:grid-cols-3 lg:gap-6 gap-4">
            @php
                $startOfWeek = now();
                $endOfWeek = now()->addDays(6);
                $period = \Carbon\CarbonPeriod::create($startOfWeek, $endOfWeek);
            @endphp

            <div>
                <button wire:key='reservation-date-1' id="dropdownHoverButton1" data-dropdown-toggle="dropdownHover1" data-dropdown-trigger="click" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-lg text-lg text-gray-700 dark:text-gray-300  shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 w-full justify-between" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check mr-2" viewBox="0 0 16 16">
                        <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    {{ \Carbon\Carbon::parse($date)->translatedFormat('d M, l') }}
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div wire:key='reservation-date-1' id="dropdownHover1" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700 max-w-60">
                    <ul class="py-2 text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton1">
                        @foreach ($period as $date)
                        <li>
                            <a href="javascript:;" wire:click="setReservationDate('{{ $date->translatedFormat('Y-m-d') }}')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-md">{{ $date->translatedFormat('d M, l') }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
                <button wire:key='reservation-date-2' id="dropdownHoverButton2" data-dropdown-toggle="dropdownHover2" data-dropdown-trigger="click" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-lg text-lg text-gray-700 dark:text-gray-300  shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 w-full justify-between" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people mr-2" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                    </svg>
                    {{ $numberOfGuests }} @lang('modules.reservation.guests')
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div wire:key='reservation-date-2' id="dropdownHover2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700 max-w-60">
                    <ul class="py-2 text-gray-700 dark:text-gray-200 max-h-72 overflow-auto" aria-labelledby="dropdownHoverButton2">
                        @for ($i = 1; $i <= 30; $i++)
                        <li>
                            <a href="javascript:;" wire:click="setReservationGuest('{{ $i }}')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-md">{{ $i }} @lang('modules.reservation.guests')</a>
                        </li>
                        @endfor
                    </ul>
                </div>
            </div>

            <div>
                <button wire:key='reservation-date-3' id="dropdownHoverButton3" data-dropdown-toggle="dropdownHover3" data-dropdown-trigger="click" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-lg text-lg text-gray-700 dark:text-gray-300  shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 w-full justify-between" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock mr-2" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                    </svg>
                    @lang('modules.reservation.' . $slotType)
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <div wire:key='reservation-date-3' id="dropdownHover3" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-full dark:bg-gray-700 max-w-60">
                    <ul class="py-2 text-gray-700 dark:text-gray-200 max-h-72 overflow-auto" aria-labelledby="dropdownHoverButton3">
                        <li>
                            <a href="javascript:;" wire:click="setReservationSlotType('Breakfast')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-md">
                                @lang('modules.reservation.Breakfast')
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" wire:click="setReservationSlotType('Lunch')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-md">
                                @lang('modules.reservation.Lunch')
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" wire:click="setReservationSlotType('Dinner')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-md">
                                @lang('modules.reservation.Dinner')
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <h4 class="text-xl font-semibold dark:text-white mt-10">@lang('messages.selectTimeSlot')</h4>
        
        <!-- Debug info -->
        @if(config('app.debug'))
        <div class="bg-gray-100 p-2 rounded text-xs mb-4">
            <strong>Debug:</strong> 
            Available time slots: {{ count($timeSlots) }} | 
            Selected: {{ $availableTimeSlots ?: 'None' }} |
            Selected table: {{ $selectedTable ? $selectedTable->table_code : 'None' }}
        </div>
        @endif
        
        <div class="mt-2 space-y-2">
            @if(empty($timeSlots))
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                        <span class="text-yellow-800">
                            No time slots available for {{ $slotType }} on {{ \Carbon\Carbon::parse($date)->format('l') }}. Please try a different day or time period.
                        </span>
                    </div>
                </div>
            @else
                <ul class="grid w-full lg:gap-6 gap-4 lg:grid-cols-6">
                    @foreach ($timeSlots as $timeSlot)
                    <li wire:key='timeSlot.{{ $loop->index }}'>
                        <input type="radio" id="timeSlot{{ $loop->index }}" wire:model="availableTimeSlots" value="{{ $timeSlot }}" class="hidden peer" />
                        <label for="timeSlot{{ $loop->index }}" class="inline-flex items-center justify-center w-full p-2 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-skin-base peer-checked:border-skin-base peer-checked:text-skin-base hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-md font-medium">{{ \Carbon\Carbon::parse($timeSlot)->translatedFormat('h:i A') }}</div>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
            @endif
            @error('availableTimeSlots') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        </div>

        <!-- Show message if no time slots are available -->
        @if (empty($timeSlots))
        <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                <span class="font-medium text-yellow-800 dark:text-yellow-200">
                    No reservation time slots are configured for {{ $slotType }} on {{ \Carbon\Carbon::parse($date)->format('l') }}s at this branch. Please contact the restaurant or try a different day/time.
                </span>
            </div>
        </div>
        @endif

        @if (!empty($timeSlots))
        <div>
            <x-label for="specialRequest" :value="__('app.specialRequest')" />
            <x-textarea class="block mt-1 w-full" wire:model="specialRequest" rows="2" />
            <x-input-error for="specialRequest" class="mt-2" />
        </div>
        @endif

        <!-- Branch Information -->
        @if($shopBranch)
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="font-medium text-blue-800 dark:text-blue-200">
                    Showing tables for: {{ $shopBranch->branch_name ?? 'Branch #' . $shopBranch->id }}
                </span>
            </div>
        </div>
        @endif

        <!-- Cinema-Style Table Selection -->
        <!-- Show tables if time slots are available OR if we want to show them for preview -->
        @if (!empty($timeSlots) || true)
        <div class="mt-8">
            <!-- Legend -->
            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 mb-6">
                <div class="flex flex-wrap justify-center gap-6">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-green-500 rounded border shadow-sm"></div>
                        <span class="text-sm font-medium dark:text-white">@lang('modules.table.available')</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-red-600 rounded border shadow-sm opacity-80 transform scale-95"></div>
                        <span class="text-sm font-medium dark:text-white">@lang('modules.reservation.reserved') (Confirmed)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-blue-500 rounded border-2 border-blue-300 shadow-sm"></div>
                        <span class="text-sm font-medium dark:text-white">@lang('modules.table.selected')</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-gray-400 rounded border shadow-sm"></div>
                        <span class="text-sm font-medium dark:text-white">@lang('modules.table.unavailable')</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 bg-yellow-500 rounded border shadow-sm"></div>
                        <span class="text-sm font-medium dark:text-white">VIP</span>
                    </div>
                </div>
            </div>

            @forelse ($tables as $area)
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 mb-6">
                <!-- Kitchen/Service Area for first section -->
                @if ($loop->first)
                <div class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 rounded-lg p-4 mb-6 text-center border-2 border-dashed border-gray-300 dark:border-gray-500">
                    <div class="text-lg font-semibold text-gray-600 dark:text-gray-300">🍳 Kitchen & Service Area 🍳</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Food preparation and service counter</div>
                </div>
                @endif

                <!-- Area Header -->
                <div class="text-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                        @if($area->area_name === 'VIP' || str_contains(strtolower($area->area_name), 'vip'))
                            👑 {{ $area->area_name }} 👑
                        @elseif(str_contains(strtolower($area->area_name), 'outdoor') || str_contains(strtolower($area->area_name), 'terrace'))
                            🌿 {{ $area->area_name }} 🌿
                        @else
                            {{ $area->area_name }}
                        @endif
                    </h3>
                    <span class="px-3 py-1 text-sm rounded-full bg-slate-100 border-gray-300 border text-gray-800 dark:bg-gray-600 dark:text-gray-200">
                        {{ $area->tables->count() }} @lang('modules.table.table')
                    </span>
                </div>

                <!-- Cinema-Style Table Grid -->
                <div class="cinema-area @if(str_contains(strtolower($area->area_name), 'outdoor')) bg-green-50 dark:bg-green-900/20 @else bg-gray-50 dark:bg-gray-900/20 @endif rounded-lg p-6">                    @php
                        // Get tables with grid positions for this area
                        $gridTables = $area->tables->whereNotNull('grid_row')->whereNotNull('grid_col');
                        $nonGridTables = $area->tables->filter(function($table) {
                            return is_null($table->grid_row) || is_null($table->grid_col);
                        });
                        
                        if ($gridTables->count() > 0) {
                            $maxRow = $gridTables->max('grid_row') ?: 5;
                            $maxCol = $gridTables->max('grid_col') ?: 8;
                            
                            // Create a grid map for positioning
                            $gridMap = [];
                            foreach ($gridTables as $table) {
                                $gridMap[$table->grid_row][$table->grid_col] = $table;
                            }
                        }
                    @endphp

                    @if($gridTables->count() > 0)
                        <!-- Cinema-Style Grid Layout with Proper Positioning -->
                        <div class="overflow-x-auto">
                            <div class="inline-grid gap-2 mx-auto min-w-max" 
                                 style="grid-template-columns: repeat({{ $maxCol }}, minmax(80px, 1fr));">
                                @for($row = 1; $row <= $maxRow; $row++)
                                    @for($col = 1; $col <= $maxCol; $col++)
                                        @php
                                            $table = $gridMap[$row][$col] ?? null;
                                            $isReserved = $table ? $reservations->contains('table_id', $table->id) : false;
                                            $isVIP = $table && (str_contains(strtolower($area->area_name), 'vip') || $table->seating_capacity >= 8);
                                            $isSelected = $table && $selectedTable && $selectedTable->id === $table->id;
                                        @endphp
                                        
                                        @if($table)
                                            <!-- Table Button -->
                                            <div wire:key='grid-table-{{ $table->id }}'
                                                 style="grid-column: span {{ $table->grid_width ?? 1 }}; grid-row: span {{ $table->grid_height ?? 1 }};">
                                                <button
                                                    wire:click="selectTable({{ $table->id }})"
                                                    class="relative w-full aspect-square rounded-lg border-2 text-white font-bold transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md flex flex-col items-center justify-center
                                                    @if($table->status == 'active' && !$isReserved && !$isVIP) bg-green-500 border-green-400 hover:bg-green-600 hover:scale-105 hover:shadow-lg cursor-pointer
                                                    @elseif($table->status == 'active' && !$isReserved && $isVIP) bg-yellow-500 border-yellow-400 hover:bg-yellow-600 hover:scale-105 hover:shadow-lg cursor-pointer
                                                    @elseif($isReserved) bg-red-600 border-red-500 opacity-80 cursor-not-allowed transform scale-95 shadow-inner animate-pulse
                                                    @elseif($table->status != 'active' && !$isReserved) bg-gray-400 border-gray-300 cursor-not-allowed opacity-75
                                                    @elseif($isSelected && !$isReserved) ring-4 ring-blue-300 bg-blue-500 border-blue-400 scale-105
                                                    @endif"
                                                    @if($table->status != 'active' || $isReserved) disabled @endif
                                                    title="{{ $isReserved ? 'This table is reserved and cannot be selected' : ($table->status != 'active' ? 'This table is not available' : 'Click to select this table') }}"
                                                >
                                                    <div class="text-center">
                                                        <div class="font-bold text-sm mb-1">{{ $table->table_code }}</div>
                                                        <div class="text-xs opacity-90">{{ $table->seating_capacity }} seats</div>
                                                        @if($isReserved)
                                                            <div class="text-xs mt-1 bg-white bg-opacity-30 rounded px-1 font-bold">🔒 RESERVED</div>
                                                        @elseif($table->status != 'active')
                                                            <div class="text-xs mt-1 bg-white bg-opacity-20 rounded px-1">N/A</div>
                                                        @elseif($isVIP)
                                                            <div class="text-xs mt-1 bg-white bg-opacity-20 rounded px-1">VIP</div>
                                                        @elseif($isSelected)
                                                            <div class="text-xs mt-1 bg-white bg-opacity-20 rounded px-1">Selected</div>
                                                        @endif
                                                    </div>
                                                    
                                                    <!-- Status indicator -->
                                                    <div class="absolute top-1 right-1 w-3 h-3 rounded-full border border-white
                                                    @if($table->status == 'active' && !$isReserved && !$isVIP) bg-green-300
                                                    @elseif($isVIP && !$isReserved) bg-yellow-300
                                                    @elseif($isReserved) bg-red-300
                                                    @elseif($table->status != 'active') bg-gray-300
                                                    @elseif($isSelected) bg-blue-300
                                                    @endif"></div>
                                                </button>
                                            </div>
                                        @else
                                            <!-- Empty space -->
                                            <div class="aspect-square bg-transparent"></div>
                                        @endif
                                    @endfor
                                    
                                    <!-- Add walkway after every 2 rows -->
                                    @if($row % 2 == 0 && $row < $maxRow)
                                        <div class="col-span-full h-4 flex items-center justify-center">
                                            <div class="border-t-2 border-dashed border-gray-300 dark:border-gray-600 w-full text-center">
                                                <span class="bg-gray-50 dark:bg-gray-800 px-2 text-xs text-gray-400">🚶 Walkway 🚶</span>
                                            </div>
                                        </div>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    @endif

                    <!-- Tables without grid positions (fallback to simple layout) -->
                    @if($nonGridTables->count() > 0)
                        @if($gridTables->count() > 0)
                            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-600">
                                <h4 class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-4">Additional Tables:</h4>
                            </div>
                        @endif
                        
                        <div class="grid gap-3 justify-center" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
                            @foreach ($nonGridTables as $table)
                                @php
                                    $isReserved = $reservations->contains('table_id', $table->id);
                                    $isVIP = str_contains(strtolower($area->area_name), 'vip') || $table->seating_capacity >= 8;
                                    $isSelected = $selectedTable && $selectedTable->id === $table->id;
                                @endphp

                                <button
                                    wire:key='non-grid-table-{{ $table->id }}'
                                    wire:click="selectTable({{ $table->id }})"
                                    class="aspect-square p-2 rounded-lg shadow-md transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 text-white font-semibold text-sm flex flex-col items-center justify-center
                                    @if($table->status == 'active' && !$isReserved && !$isVIP) bg-green-500 hover:bg-green-600 hover:scale-105 hover:shadow-lg cursor-pointer
                                    @elseif($table->status == 'active' && !$isReserved && $isVIP) bg-yellow-500 hover:bg-yellow-600 hover:scale-105 hover:shadow-lg cursor-pointer
                                    @elseif($isReserved) bg-red-600 border-red-500 opacity-80 cursor-not-allowed transform scale-95 shadow-inner animate-pulse
                                    @elseif($table->status != 'active' && !$isReserved) bg-gray-400 cursor-not-allowed opacity-75
                                    @elseif($isSelected && !$isReserved) ring-4 ring-blue-300 bg-blue-500 scale-105
                                    @endif"
                                    @if($table->status != 'active' || $isReserved) disabled @endif
                                    title="{{ $isReserved ? 'This table is reserved and cannot be selected' : ($table->status != 'active' ? 'This table is not available' : 'Click to select this table') }}"
                                >
                                    <div class="text-center">
                                        <div class="font-bold text-xs mb-1">{{ $table->table_code }}</div>
                                        <div class="text-xs">{{ $table->seating_capacity }} seats</div>
                                        @if($isReserved)
                                            <div class="text-xs mt-1 font-bold">🔒 RESERVED</div>
                                        @elseif($table->status != 'active')
                                            <div class="text-xs mt-1">N/A</div>
                                        @elseif($isVIP)
                                            <div class="text-xs mt-1">VIP</div>
                                        @elseif($isSelected)
                                            <div class="text-xs mt-1">Selected</div>
                                        @endif
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Quick View Button -->
                @if($area->tables->first() && (!empty($area->tables->first()->getRegularPictures()) || $area->tables->first()->getPanoramaPicture()))
                <div class="text-center mt-4">
                    <button wire:click="viewTable({{ $area->tables->first()->id }})"
                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm font-medium">
                        👁️ @lang('modules.table.view') {{ $area->area_name }} Pictures
                    </button>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-8">
                <div class="text-gray-500 dark:text-gray-400">
                    @lang('messages.noAreasAvailable')
                </div>
            </div>
            @endforelse
        </div>
        @endif

        <!-- Proceed to Payment Button -->
        @if($selectedTable && !empty($availableTimeSlots))
        <div class="mt-8 text-center">
            <button wire:click="proceedToPayment" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200">
                @lang('modules.reservation.proceedToPayment')
            </button>
        </div>
        @endif

        <!-- Payment Modal -->
        @if($showPaymentModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="payment-modal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between pb-4 border-b dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            @lang('modules.reservation.paymentDetails')
                        </h3>
                        <button wire:click="$set('showPaymentModal', false)" 
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Reservation Summary -->
                    <div class="mt-4 bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">@lang('modules.reservation.reservationSummary')</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">@lang('modules.table.table'):</span>
                                <span class="font-medium dark:text-white">{{ $selectedTable->table_code ?? '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">@lang('modules.reservation.date'):</span>
                                <span class="font-medium dark:text-white">{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">@lang('modules.reservation.time'):</span>
                                <span class="font-medium dark:text-white">{{ \Carbon\Carbon::parse($availableTimeSlots)->format('h:i A') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-300">@lang('modules.reservation.guests'):</span>
                                <span class="font-medium dark:text-white">{{ $numberOfGuests }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Amount -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            @lang('modules.reservation.advancePayment')
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                            <input type="number" 
                                   wire:model="advancePaymentAmount" 
                                   step="0.01" 
                                   min="0"
                                   class="pl-8 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        @error('advancePaymentAmount') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Payment Methods -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            @lang('modules.reservation.paymentMethod')
                        </label>
                        <div class="space-y-2">
                            @foreach($availablePaymentMethods as $method)
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600">
                                <input type="radio" 
                                       wire:model="paymentMethod" 
                                       value="{{ $method }}" 
                                       class="mr-3 text-blue-600">
                                <div class="flex items-center">
                                    @if($method === 'stripe')
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="none">
                                            <path d="M13.976 9.15c-2.172-.806-3.356-1.426-3.356-2.409 0-.831.683-1.305 1.901-1.305 2.227 0 4.515.858 6.09 1.631l.89-5.494C18.252.975 15.697 0 12.165 0 9.667 0 7.589.654 6.104 1.872 4.56 3.147 3.757 4.992 3.757 7.218c0 4.039 2.467 5.76 6.476 7.219 2.585.92 3.445 1.574 3.445 2.583 0 .98-.84 1.545-2.354 1.545-1.875 0-4.965-.921-6.99-2.109l-.9 5.555C5.175 22.99 8.385 24 11.714 24c2.641 0 4.843-.624 6.328-1.813 1.664-1.305 2.525-3.236 2.525-5.732 0-4.128-2.524-5.851-6.591-7.305z" fill="#635BFF"/>
                                        </svg>
                                        <span class="dark:text-white">Stripe</span>
                                    @elseif($method === 'razorpay')
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="#3395FF">
                                            <path d="M22.436 0l-11.91 7.773-1.174 4.276 6.625-4.297L22.436 0zM14.26 10.098L3.389 17.166 1.564 24l9.814-6.358 2.882-7.544z"/>
                                        </svg>
                                        <span class="dark:text-white">Razorpay</span>
                                    @elseif($method === 'flutterwave')
                                        <svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="#f5a623">
                                            <path d="M8.64 5.76L12 2.4l3.36 3.36L12 9.12 8.64 5.76zM2.4 12l3.36-3.36L9.12 12l-3.36 3.36L2.4 12zm11.52 0l3.36-3.36L20.64 12l-3.36 3.36L13.92 12zM8.64 18.24L12 14.88l3.36 3.36L12 21.6l-3.36-3.36z"/>
                                        </svg>
                                        <span class="dark:text-white">Flutterwave</span>
                                    @else
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v2a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="dark:text-white">@lang('modules.reservation.cashPayment')</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                        @error('paymentMethod') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t dark:border-gray-600">
                        <button wire:click="$set('showPaymentModal', false)" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            @lang('app.cancel')
                        </button>
                        <button wire:click="processPayment" 
                                wire:loading.attr="disabled"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50">
                            <span wire:loading.remove wire:target="processPayment">
                                @if($paymentMethod === 'cash')
                                    @lang('modules.reservation.confirmReservation')
                                @else
                                    @lang('modules.reservation.processPayment')
                                @endif
                            </span>
                            <span wire:loading wire:target="processPayment">
                                @lang('app.processing')...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Table Selection Modal -->
        @if($showTableModal && $selectedTable)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 shadow-lg rounded-md bg-white dark:bg-gray-800">
                <div class="mt-3 text-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        @lang('modules.table.confirmSelection')
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                        <p class="text-gray-700 dark:text-gray-300">
                            @lang('modules.table.selectedTable'): <strong>{{ $selectedTable->table_code }}</strong><br>
                            @lang('modules.table.capacity'): <strong>{{ $selectedTable->seating_capacity }} @lang('modules.reservation.guests')</strong><br>
                            @lang('modules.reservation.date'): <strong>{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</strong><br>
                            @lang('modules.reservation.time'): <strong>{{ \Carbon\Carbon::parse($availableTimeSlots)->format('h:i A') }}</strong>
                        </p>
                    </div>
                    <div class="flex justify-center space-x-3">
                        <button wire:click="$set('showTableModal', false)" 
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                            @lang('app.cancel')
                        </button>
                        <button wire:click="proceedToPayment" 
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            @lang('modules.reservation.proceedToPayment')
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Debug Test Button -->
        @if(config('app.debug'))
        <div class="bg-red-100 border border-red-300 p-4 rounded-lg mb-6">
            <h4 class="font-bold text-red-800 mb-3">🔧 Debug Controls</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-2 mb-3">
                <button wire:click="$set('showPaymentModal', true)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Force Show Modal
                </button>
                <button wire:click="testPaymentModal" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Test Modal
                </button>
                <button wire:click="$set('showPaymentModal', false)" class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Hide Modal
                </button>
                <button wire:click="debugState" class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Debug State
                </button>
                <button wire:click="forceShowModal" class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Force Modal
                </button>
                <button wire:click="simpleModalTest" class="bg-pink-500 hover:bg-pink-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Simple Test
                </button>
                <button wire:click="forceModalTrue" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm font-medium">
                    Force True
                </button>
            </div>
            <div class="text-sm bg-white p-2 rounded border">
                <strong>Status:</strong> 
                Modal: <span class="font-mono {{ $showPaymentModal ? 'text-green-600' : 'text-red-600' }}">{{ $showPaymentModal ? 'ON' : 'OFF' }}</span> | 
                Table: <span class="font-mono">{{ $selectedTable ? $selectedTable->table_code : 'None' }}</span> |
                Payment Methods: <span class="font-mono">{{ count($availablePaymentMethods) }}</span> |
                Current Method: <span class="font-mono">{{ $paymentMethod ?: 'None' }}</span>
            </div>
        </div>
        @endif

        @if (is_null(customer()))
        <x-button type="button" wire:click="$dispatch('showSignup')">@lang('messages.loginForReservation')</x-button>
        @else
            @if($selectedTable && !empty($availableTimeSlots))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-green-800">
                                Table {{ $selectedTable->table_code }} selected for {{ \Carbon\Carbon::parse($availableTimeSlots)->format('h:i A') }}
                            </p>
                            <p class="text-xs text-green-600 mt-1">
                                Click on the table again to proceed with payment and confirm your reservation.
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-blue-800">
                                Please select a table and time slot to proceed with your reservation.
                            </p>
                            <p class="text-xs text-blue-600 mt-1">
                                An advance payment of ${{ number_format($advancePaymentAmount, 2) }} will be required to confirm your booking.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Table Pictures Modal -->
    @if($showPicturesModal && $viewingTable)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="pictures-modal-title" role="dialog" aria-modal="true"
         x-data
         x-on:open-panorama-viewer.window="window.open($event.detail.url, '_blank')">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="pictures-modal-title">
                                    {{ $viewingTable->table_code }} - @lang('modules.table.pictures')
                                </h3>
                                <button wire:click="$set('showPicturesModal', false)" type="button" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            @if(count($viewingTable->pictures ?? []) > 0)
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @if($viewingTable->getPanoramaPicture())
                                        <div class="relative group col-span-2 md:col-span-3">
                                            <img wire:click="openPanoramaViewer({{ $viewingTable->id }})"
                                                 src="{{ Storage::url($viewingTable->getPanoramaPicture()) }}"
                                                 alt="Panorama picture"
                                                 class="w-full h-64 object-cover rounded-lg cursor-pointer">
                                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-sm">
                                                @lang('modules.table.panoramaView')
                                            </div>
                                        </div>
                                    @endif
                                    @foreach($viewingTable->getRegularPictures() as $picture)
                                        <div class="relative group">
                                            <img src="{{ Storage::url($picture['path']) }}" alt="Table picture" class="w-full h-48 object-cover rounded-lg">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-gray-500">@lang('messages.noPicturesAvailable')</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="$set('showPicturesModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-skin-base sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ trans('app.close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif


</div>
    <!-- Payment Modal -->
    <!-- Debug: showPaymentModal = {{ $showPaymentModal ? 'true' : 'false' }}, selectedTable = {{ $selectedTable ? $selectedTable->id : 'null' }} -->
    

    
    @if($showPaymentModal)
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 !m-0" style="z-index: 9999 !important; background-color: rgba(0,0,0,0.8) !important;">
        <div class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md p-6 relative flex flex-col mx-2 md:m-0 max-h-[40rem] w-full max-w-lg overflow-y-auto" style="background-color: white !important; border: 3px solid red !important;">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4 text-center">
                💳 Payment Modal Test
            </h2>
            
            <div class="bg-green-100 border border-green-300 p-3 rounded mb-4">
                <p class="text-green-800 text-sm">✅ Payment modal is working! State: {{ $showPaymentModal ? 'TRUE' : 'FALSE' }}</p>
                <p class="text-green-800 text-sm">Table: {{ $selectedTable ? $selectedTable->table_code : 'None' }}</p>
                <p class="text-green-800 text-sm">Payment Methods: {{ count($availablePaymentMethods) }}</p>
            </div>
            
            <!-- Reservation Summary -->
            @if($selectedTable)
            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4">
                <h3 class="font-bold text-gray-800 dark:text-white mb-3">Reservation Summary</h3>
                <div class="text-sm text-gray-600 dark:text-gray-300 space-y-2">
                    <div class="flex justify-between">
                        <span>Table:</span>
                        <span class="font-medium">{{ $selectedTable->table_code }} ({{ $selectedTable->seating_capacity }} seats)</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Date:</span>
                        <span class="font-medium">{{ \Carbon\Carbon::parse($date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Time:</span>
                        <span class="font-medium">{{ $availableTimeSlots ? \Carbon\Carbon::parse($availableTimeSlots)->format('h:i A') : 'Not selected' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Guests:</span>
                        <span class="font-medium">{{ $numberOfGuests }}</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-300 dark:border-gray-600 pt-2 mt-2">
                        <span class="font-bold">Advance Payment:</span>
                        <span class="font-bold text-green-600">${{ number_format($advancePaymentAmount, 2) }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Methods -->
            <div class="mb-4">
                <h3 class="font-bold text-gray-800 dark:text-white mb-3">Choose Payment Method:</h3>
                <div class="space-y-3">
                    @foreach($availablePaymentMethods as $method)
                    <label class="flex items-center p-3 border-2 border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors {{ $paymentMethod === $method ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/20' : '' }}">
                        <input type="radio" wire:model.live="paymentMethod" value="{{ $method }}" class="mr-3 text-blue-600">
                        @if($method === 'stripe')
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white text-lg">💳</span>
                            </div>
                            <span class="font-medium text-gray-800 dark:text-white">Credit/Debit Card (Stripe)</span>
                        @elseif($method === 'razorpay')
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white text-lg">🏦</span>
                            </div>
                            <span class="font-medium text-gray-800 dark:text-white">UPI/Cards (Razorpay)</span>
                        @elseif($method === 'flutterwave')
                            <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white text-lg">📱</span>
                            </div>
                            <span class="font-medium text-gray-800 dark:text-white">Mobile Money (Flutterwave)</span>
                        @elseif($method === 'cash')
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                <span class="text-white text-lg">💵</span>
                            </div>
                            <span class="font-medium text-gray-800 dark:text-white">Pay at Restaurant (Cash)</span>
                        @endif
                    </label>
                    @endforeach
                </div>
                @error('paymentMethod') 
                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 justify-end pt-4 border-t border-gray-200 dark:border-gray-600">
                <button wire:click="$set('showPaymentModal', false)" 
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors">
                    Cancel
                </button>
                <button wire:click="processPayment" 
                        wire:loading.attr="disabled"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors disabled:opacity-50">
                    <span wire:loading.remove wire:target="processPayment">
                        @if($paymentMethod === 'cash')
                            Reserve Table
                        @else
                            Pay ${{ number_format($advancePaymentAmount, 2) }}
                        @endif
                    </span>
                    <span wire:loading wire:target="processPayment" class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Processing...
                    </span>
                </button>
            </div>
        </div>
    </div>
    @endif


</div>