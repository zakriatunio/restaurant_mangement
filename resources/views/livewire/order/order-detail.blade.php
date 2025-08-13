<div>
    <x-right-modal wire:model.live="showOrderDetail">
        <x-slot name="title">
            @if ($order)
                <h2 class="text-lg flex justify-between">
                    <div>@lang('modules.order.orderNumber') #{{ $order->order_number }}</div>

                    @if ($order->waiter)
                    <div class="inline-flex items-center text-gray-600 text-sm gap-1 dark:text-gray-400">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 -2.89 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="enable-background:new 0 0 122.88 117.09" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css">.st0{fill-rule:evenodd;clip-rule:evenodd;}</style> <g> <path class="st0" d="M36.82,107.86L35.65,78.4l13.25-0.53c5.66,0.78,11.39,3.61,17.15,6.92l10.29-0.41c4.67,0.1,7.3,4.72,2.89,8 c-3.5,2.79-8.27,2.83-13.17,2.58c-3.37-0.03-3.34,4.5,0.17,4.37c1.22,0.05,2.54-0.29,3.69-0.34c6.09-0.25,11.06-1.61,13.94-6.55 l1.4-3.66l15.01-8.2c7.56-2.83,12.65,4.3,7.23,10.1c-10.77,8.51-21.2,16.27-32.62,22.09c-8.24,5.47-16.7,5.64-25.34,1.01 L36.82,107.86L36.82,107.86z M29.74,62.97h91.9c0.68,0,1.24,0.57,1.24,1.24v5.41c0,0.67-0.56,1.24-1.24,1.24h-91.9 c-0.68,0-1.24-0.56-1.24-1.24v-5.41C28.5,63.53,29.06,62.97,29.74,62.97L29.74,62.97z M79.26,11.23 c25.16,2.01,46.35,23.16,43.22,48.06l-93.57,0C25.82,34.23,47.09,13.05,72.43,11.2V7.14l-4,0c-0.7,0-1.28-0.58-1.28-1.28V1.28 c0-0.7,0.57-1.28,1.28-1.28h14.72c0.7,0,1.28,0.58,1.28,1.28v4.58c0,0.7-0.58,1.28-1.28,1.28h-3.89L79.26,11.23L79.26,11.23 L79.26,11.23z M0,77.39l31.55-1.66l1.4,35.25L1.4,112.63L0,77.39L0,77.39z"></path> </g> </g></svg>

                        {{ $order->waiter->name ?? '--' }}
                    </div>
                    @endif

                    <div class="inline-flex gap-2 items-center">
                        @if ($order->order_type == 'pickup')
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bag-fill" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                            </svg>
                        @elseif($order->order_type == 'delivery')
                            <svg class="w-6 h-6 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" version="1.0" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(0 512) scale(.1 -.1)">
                                    <path
                                        d="m2605 4790c-66-13-155-48-213-82-71-42-178-149-220-221-145-242-112-552 79-761 59-64 61-67 38-73-13-4-60-24-104-46-151-75-295-249-381-462-20-49-38-91-39-93-2-2-19 8-40 22s-54 30-74 36c-59 16-947 12-994-4-120-43-181-143-122-201 32-33 76-33 106 0 41 44 72 55 159 55h80v-135c0-131 1-137 25-160l24-25h231 231l24 25c24 23 25 29 25 161v136l95-4c82-3 97-6 117-26l23-23v-349-349l-46-46-930-6-29 30c-17 16-30 34-30 40 0 7 34 11 95 11 88 0 98 2 120 25 16 15 25 36 25 55s-9 40-25 55c-22 23-32 25-120 25h-95v80 80h55c67 0 105 29 105 80 0 19-9 40-25 55l-24 25h-231-231l-24-25c-33-32-33-78 0-110 22-23 32-25 120-25h95v-80-80h-175c-173 0-176 0-200-25-33-32-33-78 0-110 24-25 27-25 197-25h174l12-45c23-88 85-154 171-183 22-8 112-12 253-12h220l-37-43c-103-119-197-418-211-669-7-115-7-116 19-142 26-25 29-26 164-26h138l16-69c55-226 235-407 464-466 77-20 233-20 310 0 228 59 409 240 463 464l17 71h605 606l13-62c58-281 328-498 621-498 349 0 640 291 640 640 0 237-141 465-350 569-89 43-193 71-271 71h-46l-142 331c-78 183-140 333-139 335 2 1 28-4 58-12 80-21 117-18 145 11l25 24v351 351l-26 26c-24 24-30 25-91 20-130-12-265-105-317-217l-23-49-29 30c-16 17-51 43-79 57-49 26-54 27-208 24-186-3-227 9-300 87-43 46-137 173-137 185 0 3 10 6 23 6s48 12 78 28c61 31 112 91 131 155 7 25 25 53 45 70 79 68 91 152 34 242-17 27-36 65-41 85-13 46-13 100 0 100 6 0 22 11 35 25 30 29 33 82 10 190-61 290-332 508-630 504-38-1-88-5-110-9zm230-165c87-23 168-70 230-136 55-57 108-153 121-216l6-31-153-4c-131-3-161-6-201-25-66-30-133-96-165-162-26-52-28-66-31-210l-4-153-31 6c-63 13-159 66-216 121-66 62-113 143-136 230-88 339 241 668 580 580zm293-619c7-41 28-106 48-147l36-74-24-15c-43-28-68-59-68-85 0-40-26-92-54-110-30-20-127-16-211 8l-50 14-3 175c-2 166-1 176 21 218 35 67 86 90 202 90h91l12-74zm-538-496c132-25 214-88 348-269 101-137 165-199 241-237 31-15 57-29 59-30s-6-20-17-43c-12-22-27-75-33-117-12-74-12-76-38-71-149 30-321 156-424 311-53 80-90 95-140 55-48-38-35-89 52-204l30-39-28-36c-42-54-91-145-110-208l-18-57-337-3-338-2 6 82c9 112 47 272 95 400 135 357 365 522 652 468zm1490-630c0-254 1-252-83-167-54 53-77 104-77 167s23 114 77 168c84 84 83 86 83-168zm-454 63c18-13 41-46 57-83l26-61-45-19c-75-33-165-52-244-54l-75-1-3 29c-8 72 44 166 113 201 42 22 132 16 171-12zm-2346-63v-80h-120-120v80 80h120 120v-80zm1584-184c80-52 154-84 261-111l90-23 112-483c68-295 112-506 112-540 1-68-21-134-56-171l-26-27-17 48c-29 86-99 159-177 186l-38 13-6 279c-5 297-5 297-64 414-58 113-212 233-328 254-21 4-41 14-44 21-12 32 88 201 111 186 6-4 37-24 70-46zm1099-493 185-433-348-490h-138-138l33 68c40 81 56 176 44 252-8 47-203 894-217 941-4 13 9 17 75 23 80 6 230 44 280 71 14 7 29 10 32 7 4-4 90-202 192-439zm-1323 187c118-22 229-99 275-190 37-74 45-138 45-375v-225h-160-160v115c0 179-47 289-158 369-91 67-141 76-417 76h-244l10 32c5 18 9 72 9 120v88h374c209 0 397-4 426-10zm-319-402c50-15 111-67 135-115 16-32 20-70 24-244l5-205 36-72 35-72h-759-759l7 63c17 164 95 400 165 502 47 68 129 124 215 145 52 13 853 12 896-2zm2114-323c256-67 415-329 350-580-48-184-202-326-390-358-197-34-412 76-500 257-19 39-38 86-41 104l-6 32h80 81l24-53c31-69 86-123 156-156 77-36 192-36 266-1 63 31 124 91 156 155 33 68 34 197 2 267-27 60-95 127-156 157-95 46-229 36-311-22-18-12-26-15-21-6 13 22 126 182 143 202 19 22 86 23 167 2zm-1315-243c39-21 87-99 77-125-6-15-27-17-178-17-193 0-231 7-289 58-35 29-70 78-70 97 0 3 96 5 213 5 187 0 217-2 247-18zm1288-89c51-38 67-70 67-133s-16-95-69-134c-43-33-132-29-179 7-20 15-37 32-37 38 0 5 36 9 80 9 73 0 83 3 105 25 33 32 33 78 0 110-22 22-32 25-105 25-44 0-80 4-80 8 0 12 29 37 65 57 39 21 117 15 153-12zm-397-46c-10-9-11-8-5 6 3 10 9 15 12 12s0-11-7-18zm-2460-217c45-106 169-184 289-184s244 78 289 184l22 50h81 81l-7-32c-13-65-66-159-123-219-186-195-500-195-686 0-57 60-110 154-123 219l-6 32h80 81l22-50zm419 41c0-16-51-50-91-63-30-8-48-8-78 0-40 13-91 47-91 63 0 5 57 9 130 9s130-4 130-9z" />
                                </g>
                            </svg>
                        @else
                            <svg class="w-6 h-6 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" version="1.0" viewBox="0 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g transform="translate(0 512) scale(.1 -.1)">
                                    <path
                                        d="m249 4691c-19-20-29-40-29-60 0-16-14-243-31-503s-28-495-25-522 19-77 35-111c46-100 126-167 236-200l40-12 3-400 2-401-25-6c-58-15-56 21-53-867l3-814 23-45c35-72 75-114 144-151 58-31 70-34 148-34s90 3 148 34c70 38 100 69 140 145l27 51 5 293 5 294 52-64c380-466 1036-731 1654-667 645 65 1211 449 1511 1024l57 110 3-495c3-491 3-495 26-540 35-72 75-114 144-151 58-31 70-34 148-34s90 3 148 34c70 38 100 69 140 145l27 51 3 1938 2 1938-52 52-161-5c-184-6-260-25-384-93-90-50-218-178-268-268-66-120-87-202-93-370l-5-148-86 84c-469 455-1109 646-1736 517-295-61-612-212-835-399l-75-63-6 53c-4 30-15 182-24 339-12 208-21 291-32 308-31 50-98 53-130 6-15-24-15-48 6-387 12-199 24-383 27-409 5-41 3-48-19-62-28-19-159-52-234-60l-53-5v455 455l-25 24c-15 16-36 25-55 25s-40-9-55-25l-25-24v-456-457l-27 6c-16 3-53 8-83 12-69 8-174 40-188 57-7 8-3 125 14 382 30 467 30 450-1 480-33 33-70 32-106-4zm4551-1171v-1040h-320-320v783c0 512 4 804 11 843 29 162 151 321 303 394 91 44 149 57 254 59l72 1v-1040zm-1955 776c271-49 475-131 701-282 126-83 292-236 390-358l64-80v-604-603l25-24c23-24 30-25 150-25 101 0 125-3 125-14 0-34-33-179-60-269-90-288-240-529-465-745-443-426-1063-587-1665-432-403 103-777 372-1019 732l-51 76v382 381l-25 24c-13 14-31 25-40 25-14 0-15 44-13 401l3 402 40 12c111 33 189 100 238 203 29 60 32 77 34 166l1 98 49 50c243 250 626 440 978 487 44 6 94 13 110 15 60 9 352-3 430-18zm-2470-652c200-61 554-55 731 13 15 6 16 1 10-38-9-57-46-112-98-146l-42-28h-256-256l-42 28c-52 34-89 89-98 145-4 23-5 42-3 42s27-7 54-16zm425-764v-400h-80-80v400 400h80 80v-400zm78-1309c-3-739-3-750-24-777-39-53-71-69-134-69s-95 16-134 69c-21 27-21 38-24 777l-2 749h160 160l-2-749zm3920 0c-3-739-3-750-24-777-39-53-71-69-134-69s-95 16-134 69c-21 27-21 38-24 777l-2 749h160 160l-2-749z" />
                                    <path
                                        d="m2420 3834c-293-38-560-167-763-371-476-475-502-1239-60-1743 495-563 1356-588 1875-52 196 202 313 436 352 703 60 408-69 797-363 1090-182 182-382 293-631 350-83 19-331 33-410 23zm315-169c467-75 826-424 927-900 16-77 16-333 0-410-98-461-436-799-897-897-77-16-333-16-410 0-348 74-626 281-783 580-173 331-175 697-7 1032 214 427 696 672 1170 595z" />
                                </g>
                            </svg>
                        @endif
                        @lang('modules.order.' . $order->order_type)
                    </div>
                </h2>
                <div class="lg:flex gap-3 space-y-1 mt-4 justify-between items-center">
                    <div class="inline-flex gap-4">
                        @if ($order->order_type == 'dine_in')
                            @if (!is_null($order->table))
                                <div @if(user_can('Update Order')) wire:click="$toggle('showTableModal')" @endif @class([
                                    'p-3 cursor-pointer rounded-lg tracking-wide bg-skin-base/[0.2] text-skin-base',
                                    'cursor-not-allowed' => !user_can('Update Order'),
                                ])>
                                    <h3 wire:loading.class.delay='opacity-50' @class(['font-semibold'])>
                                        {{ $order->table->table_code ?? '--' }}
                                    </h3>
                                </div>
                            @elseif(user_can('Update Order'))
                                <x-secondary-button wire:click="$toggle('showTableModal')">@lang('modules.order.setTable')</x-secondary-button>
                            @endif
                        @endif

                        <div>
                            @if ($order->customer_id)
                                <div class="font-semibold text-gray-700 dark:text-gray-300">{{ $order->customer->name }}
                                </div>
                            @elseif(user_can('Update Order'))
                                <a href="javascript:;"
                                    wire:click="$dispatch('showAddCustomerModal', { id: {{ $order->id }} })"
                                    class="underline text-sm underline-offset-2">&plus; @lang('modules.order.addCustomerDetails')</a>
                            @endif
                            <div class="font-medium text-gray-600 text-xs dark:text-gray-400">
                                {{ $order->date_time->translatedFormat('F d, Y H:i A') }}</div>
                        </div>

                    </div>

                    @if ($order->order_type == 'delivery')
                        <div>
                            @if ($order->deliveryExecutive)
                                <div class="font-semibold text-gray-700 dark:text-gray-300 text-sm inline-flex flex-col gap-1">
                                    <div class="text-xs font-medium">@lang('modules.order.deliveryExecutive')</div>
                                    <div class="text-sm">{{ $order->deliveryExecutive->name }}</div>
                                </div>
                            @else
                                <x-select class="text-sm w-full" wire:model.live='deliveryExecutive' wire:change='saveDeliveryExecutive'>
                                    <option value="">@lang('modules.order.selectDeliveryExecutive')</option>
                                    @foreach ($deliveryExecutives as $deliveryExecutive)
                                        <option value="{{ $deliveryExecutive->id }}">{{ $deliveryExecutive->name }}</option>
                                    @endforeach
                                </x-select>
                            @endif
                        </div>
                    @endif

                    <div>
                        <span @class([
                            'text-xs font-medium px-2 py-1 rounded uppercase tracking-wide whitespace-nowrap',
                            'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 border border-gray-400' => $order->status == 'draft',
                            'bg-yellow-100 text-yellow-800 dark:bg-yellow-700 dark:text-yellow-400 border border-yellow-400' => $order->status == 'kot',
                            'bg-blue-100 text-blue-800 dark:bg-gray-700 dark:text-blue-400 border border-blue-400' => $order->status == 'billed' || $order->status == 'out_for_delivery',
                            'bg-green-100 text-green-800 dark:bg-gray-700 dark:text-green-400 border border-green-400' => $order->status == 'paid' || $order->status == 'delivered',
                            'bg-red-100 text-red-800 dark:bg-gray-700 dark:text-red-400 border border-red-400' => $order->status == 'canceled' || $order->status == 'payment_due',
                            'bg-orange-100 text-orange-800 dark:bg-gray-700 dark:text-orange-400 border border-orange-400' => $order->status == 'pending_verification',
                        ])>
                            @lang('modules.order.' . $order->status)
                        </span>
                    </div>

                </div>
                @if ($orderProgressStatus === 'cancelled')

                <span class="inline-block px-2 py-1 my-2 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                    @lang('modules.order.info_cancelled')
                </span>
                @else
                <div class="mb-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm py-4">
                    @php
                        $statuses = match($order->order_type) {
                            'delivery' => ['placed', 'confirmed', 'preparing', 'out_for_delivery', 'delivered'],
                            'pickup' => ['placed', 'confirmed', 'preparing', 'ready_for_pickup', 'delivered'],
                            default => ['placed', 'confirmed', 'preparing', 'served']
                        };

                        $currentIndex = array_search($orderProgressStatus, $statuses);
                        $currentIndex = $currentIndex !== false ? $currentIndex : 0;
                        $nextIndex = min($currentIndex + 1, count($statuses) - 1);
                    @endphp

                    <div class="flex flex-col space-y-4">
                        <div class="flex items-center justify-between text-gray-900 dark:text-white">
                            <h3 class="text-lg font-semibold">
                                {{ __('modules.order.orderStatus') }}
                            </h3>
                            <span
                                @class([
                                    'px-3 py-1 text-sm font-medium rounded-md',
                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300 border border-green-400' => $orderProgressStatus === 'delivered' || $orderProgressStatus === 'served',
                                    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 border border-gray-400' => $orderProgressStatus === 'placed',
                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 border border-blue-400' => $orderProgressStatus !== 'delivered' && $orderProgressStatus !== 'served' && $orderProgressStatus !== 'placed',
                                ])>
                                {{ __('modules.order.' . App\Enums\OrderStatus::from($orderProgressStatus)->label()) }}
                            </span>
                        </div>

                        <div class="relative">
                            <div class="relative flex justify-between">
                                @foreach($statuses as $index => $status)
                                    <div class="flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center mb-2
                                            @if($index <= $currentIndex)
                                                bg-skin-base text-white
                                            @else
                                                bg-gray-200 dark:bg-gray-700 text-gray-400 dark:text-gray-500
                                            @endif">
                                            @switch($status)
                                                @case('placed')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    @break
                                                @case('confirmed')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    @break
                                                @case('preparing')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 7.68 7.68" xmlns="http://www.w3.org/2000/svg"><path d="M7.584 3.072 6.72 3.72v1.8a0.961 0.961 0 0 1 -0.96 0.96H1.92a0.961 0.961 0 0 1 -0.96 -0.96v-1.8L0.096 3.072a0.24 0.24 0 0 1 0.288 -0.384L0.96 3.12V2.64a0.481 0.481 0 0 1 0.48 -0.48h4.8a0.481 0.481 0 0 1 0.48 0.48v0.48l0.576 -0.432a0.24 0.24 0 0 1 0.288 0.384M4.8 1.68a0.24 0.24 0 0 0 0.24 -0.24V0.48a0.24 0.24 0 0 0 -0.48 0v0.96a0.24 0.24 0 0 0 0.24 0.24m-0.96 0a0.24 0.24 0 0 0 0.24 -0.24V0.48a0.24 0.24 0 0 0 -0.48 0v0.96a0.24 0.24 0 0 0 0.24 0.24m-0.96 0a0.24 0.24 0 0 0 0.24 -0.24V0.48a0.24 0.24 0 0 0 -0.48 0v0.96a0.24 0.24 0 0 0 0.24 0.24" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                                    @break
                                                @case('out_for_delivery')
                                                @case('ready_for_pickup')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    </svg>
                                                    @break
                                                @case('delivered')
                                                @case('served')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    @break
                                            @endswitch
                                        </div>
                                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">
                                            {{ __('modules.order.' . App\Enums\OrderStatus::from($status)->label()) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if(user_can('Update Order'))
                            <div class="flex justify-end items-center mt-4 space-x-2">
                                @if($orderProgressStatus === 'placed')
                                    <x-danger-button class="inline-flex items-center gap-2 dark:text-gray-200" wire:click="cancelOrderStatus({{ $order->id }})">
                                        <span>{{ __('modules.order.cancelOrder') }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </x-danger-button>
                                @endif

                                @if($currentIndex < count($statuses) - 1)
                                    <x-secondary-button class="inline-flex items-center gap-2" wire:click="$set('orderProgressStatus', '{{ $statuses[$nextIndex] }}')">
                                        <span>{{ __('modules.order.moveTo') }} {{ __('modules.order.' . App\Enums\OrderStatus::from($statuses[$nextIndex])->label()) }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </x-secondary-button>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @endif
            @endif
        </x-slot>

        <x-slot name="content">
            @if ($order)
                <div class="flex flex-col rounded ">
                    <table class=" flex-1  min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="p-2 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.menu.itemName')
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs text-center text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.order.qty')
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-400 hidden lg:table-cell">
                                    @lang('modules.order.price')
                                </th>
                                <th scope="col"
                                    class="p-2 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-400">
                                    @lang('modules.order.amount')
                                </th>

                                @if (!in_array($order->status, ['paid', 'payment_due', 'canceled']) && user_can('Delete Order'))
                                    <th scope="col"
                                        class="p-2 text-xs font-medium text-gray-500 uppercase dark:text-gray-400 text-right">
                                        @lang('app.action')
                                    </th>
                                @endif

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                            wire:key='menu-item-list-{{ microtime() }}'>

                            @forelse ($order->items as $key => $item)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700"
                                    wire:key='menu-item-{{ $key . microtime() }}' wire:loading.class.delay='opacity-10'>
                                    <td class="flex flex-col p-2 mr-12 lg:min-w-28">
                                        <div class="text-xs text-gray-900 dark:text-white inline-flex items-center">
                                            {{ $item->menuItem->item_name }}
                                        </div>

                                        <div class="text-xs text-gray-600 dark:text-white inline-flex items-center">
                                            {{ isset($item->menuItemVariation) ? $item->menuItemVariation->variation : '' }}
                                        </div>

                                        @if($item->modifierOptions->isNotEmpty())
                                        <div class="text-xs text-gray-600 dark:text-white">
                                            @foreach ($item->modifierOptions as $modifier)
                                            <div
                                                class="flex items-center justify-between text-xs mb-1 py-0.5 px-1 border-l-2 border-blue-500 bg-gray-200 dark:bg-gray-900 rounded-md">
                                                <span class="text-gray-900 dark:text-white">{{ $modifier->name }}</span>
                                                <span class="text-gray-600 dark:text-gray-300">{{ currency_format($modifier->price) }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endif

                                    </td>
                                    <td
                                        class="p-2 text-xs text-gray-900 whitespace-nowrap text-center dark:text-gray-400">
                                        {{ $item->quantity }}
                                    </td>

                                    <td
                                        class="p-2 text-xs font-medium text-gray-700 whitespace-nowrap dark:text-white text-right hidden lg:table-cell">
                                        {{ currency_format($item->price) }}
                                    </td>
                                    <td
                                        class="p-2 text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white text-right">
                                        {{ currency_format($item->amount) }}
                                    </td>

                                    @if (!in_array($order->status, ['paid', 'payment_due', 'canceled']) && user_can('Delete Order'))
                                        <td class="p-2 whitespace-nowrap text-right">
                                            <button class="rounded text-gray-700 border p-2"
                                                wire:click="deleteOrderItems('{{ $item->id }}')">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    @endif

                                </tr>
                            @empty
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="p-2 space-x-6" colspan="5">
                                        @lang('messages.noItemAdded')
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div>
                    <div
                        class="h-auto p-4 mt-3 select-none text-center w-full bg-gray-50 rounded space-y-4 dark:bg-gray-700">
                        <div class="flex justify-between text-gray-500 text-sm dark:text-gray-400">
                            <div>
                                @lang('modules.order.totalItem')
                            </div>
                            <div>
                                {{ count($order->items) }}
                            </div>
                        </div>
                        <div class="flex justify-between text-gray-500 text-sm dark:text-gray-400">
                            <div>
                                @lang('modules.order.subTotal')
                            </div>
                            <div>
                                {{ currency_format($order->sub_total) }}
                            </div>
                        </div>

                        @if (!is_null($order->discount_amount))
                            <div wire:key="discountAmount"
                                class="flex justify-between text-green-500 text-sm dark:text-green-400">
                                <div>
                                    @lang('modules.order.discount') @if ($order->discount_type == 'percent')
                                        ({{ rtrim(rtrim(number_format($order->discount_value, 2), '0'), '.') }}%)
                                    @endif
                                </div>
                                <div>
                                    -{{ currency_format($order->discount_amount) }}
                                </div>
                            </div>
                        @endif

                        @foreach ($order->charges as $item)
                            <div class="flex justify-between text-gray-500 text-sm dark:text-gray-400">
                                <div class="inline-flex items-center gap-x-1">
                                    {{ $item->charge->charge_name }}
                                    @if ($item->charge->charge_type == 'percent')
                                        ({{ $item->charge->charge_value }}%)
                                    @endif

                                    @if (!in_array($order->status, ['paid', 'payment_due', 'canceled']))
                                    <span class="text-red-500 hover:scale-110 active:scale-100 cursor-pointer" wire:click="removeCharge('{{ $item->id }}')">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    @endif
                                </div>
                                <div>
                                    {{ currency_format(($item->charge->getAmount($order->sub_total - ($order->discount_amount ?? 0)))) }}
                                </div>
                            </div>
                        @endforeach

                        @if($order->tip_amount > 0)
                            <div class="flex justify-between text-gray-500 text-sm dark:text-gray-400">
                                <div>
                                    @lang('modules.order.tip')
                                </div>
                                <div>
                                    {{ currency_format($order->tip_amount) }}
                                </div>
                            </div>
                        @endif

                        @foreach ($order->taxes as $item)
                            <div class="flex justify-between text-gray-500 text-sm dark:text-gray-400">
                                <div>
                                    {{ $item->tax->tax_name }} ({{ $item->tax->tax_percent }}%)
                                </div>
                                <div>
                                    {{ currency_format(($item->tax->tax_percent / 100) * ($order->sub_total - ($order->discount_amount ?? 0))) }}
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-between font-medium dark:text-gray-400">
                            <div>
                                @lang('modules.order.total')
                            </div>
                            <div>
                                {{ currency_format($order->total) }}
                            </div>
                        </div>


                        <div class="flex justify-between font-medium dark:text-gray-400">
                            <div>
                                @lang('modules.order.balanceReturn')
                            </div>
                            <div>
                                @php
                                    $totalBalance = $order->payments->sum('balance');
                                @endphp

                                {{ currency_format($totalBalance > 0 ? $totalBalance : 0) }}
                            </div>
                        </div>

                    </div>

                    <div class="h-auto pb-4 pt-3 select-none w-full">
                        <!-- Primary Actions - Large prominent buttons -->
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            @if ($order->status == 'kot' && !is_null($order->table_id))
                                <button
                                    class="min-h-[60px] rounded-xl bg-gray-700 hover:bg-gray-800 text-white p-4 inline-flex items-center justify-center gap-3 transition-colors shadow-sm text-lg font-medium"
                                    wire:click="saveOrder('kot')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    @lang('modules.order.addItems')
                                </button>

                                <button
                                    class="min-h-[60px] rounded-xl bg-green-600 hover:bg-green-700 text-white p-4 inline-flex items-center justify-center gap-3 transition-colors shadow-sm text-lg font-medium"
                                    wire:click="saveOrder('bill')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    @lang('modules.order.bill')
                                </button>
                            @endif

                            @if (($order->status == 'billed' || $order->status == 'payment_due') && user_can('Update Order'))
                                <button
                                    class="min-h-[60px] col-span-2 rounded-xl bg-green-600 hover:bg-green-700 text-white p-4 inline-flex items-center justify-center gap-3 transition-colors shadow-sm text-lg font-medium"
                                    wire:click='showPayment({{ $order->id }})'>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                    </svg>
                                    @lang('modules.order.addPayment')
                                </button>
                            @endif
                        </div>

                        <!-- Secondary Actions - Utility buttons in a grid -->
                        <div class="grid grid-cols-4 gap-2">
                            <a class="min-h-[50px] rounded-xl bg-white hover:bg-gray-50 text-gray-700 border p-3 inline-flex flex-col items-center justify-center gap-1 transition-colors dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700"
                                href="{{ route('orders.print', $order->id) }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor"
                                    viewBox="0 0 16 16">
                                    <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                                    <path
                                        d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1" />
                                </svg>
                                <span class="text-sm font-medium">@lang('app.print')</span>
                            </a>

                            @if (in_array($order->status, ['billed', 'payment_due', 'paid']) && user_can('Delete Order'))
                                <button
                                    class="min-h-[50px] rounded-xl bg-red-600 hover:bg-red-700 text-white p-3 inline-flex flex-col items-center justify-center gap-1 transition-colors"
                                    wire:click="$toggle('cancelOrderModal')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="text-sm font-medium">@lang('app.cancel')</span>
                                </button>
                            @endif

                            @if(!in_array($order->status, ['paid', 'payment_due','canceled']))
                                @if (user_can('Delete Order'))
                                <button
                                class="min-h-[50px] rounded-xl bg-red-500 hover:bg-red-600 text-white p-3 inline-flex flex-col items-center justify-center gap-1 transition-colors"
                                    wire:click="$toggle('deleteOrderModal')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="text-sm font-medium">@lang('app.delete')</span>
                                </button>
                                @endif
                            @endif

                            <button
                                class="min-h-[50px] rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 p-3 inline-flex flex-col items-center justify-center gap-1 transition-colors dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                                wire:click="$toggle('showOrderDetail')" wire:loading.attr="disabled">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="text-sm font-medium">{{ __('app.close') }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                @if ($order->payments->count())
                    <div class="flex flex-col rounded ">
                        <table class=" flex-1  min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="p-2 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                        @lang('modules.order.amount')
                                    </th>

                                    <th scope="col"
                                        class="p-2 text-xs text-center text-gray-500 uppercase dark:text-gray-400">
                                        @lang('modules.order.paymentMethod')
                                    </th>
                                    <th scope="col"
                                        class="p-2 text-xs font-medium text-right text-gray-500 uppercase dark:text-gray-400">
                                        @lang('app.dateTime')
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                                wire:key='menu-item-list-{{ microtime() }}'>

                                @foreach ($order->payments as $key => $item)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-2 text-base text-gray-900 whitespace-nowrap dark:text-gray-400">
                                            {{ currency_format($item->amount) }}
                                        </td>


                                        <td @class([
                                            'p-2 text-base text-gray-900 whitespace-nowrap text-center dark:text-gray-400',
                                        ])>
                                            <div @class([
                                                'inline-flex items-center gap-1 justify-center',
                                                'px-2 py-0.5 text-sm rounded bg-red-100 text-red-800 dark:bg-red-700 dark:text-red-400 border border-red-400' =>
                                                    $item->payment_method == 'due',
                                            ])>
                                                @switch($item->payment_method)
                                                    @case('cash')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                                                            <path
                                                                d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                                                            <path
                                                                d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z" />
                                                        </svg>
                                                    @break

                                                    @case('upi')
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                                                        <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z"/>
                                                        <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z"/>
                                                        <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z"/>
                                                        <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z"/>
                                                        <path d="M12 9h2V8h-2z"/>
                                                    </svg>
                                                    @break

                                                    @case('card')
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-credit-card"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                                            <path
                                                                d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                                        </svg>
                                                    @break

                                                    @default
                                                @endswitch
                                                @lang('modules.order.' . $item->payment_method)
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 text-base text-gray-900 whitespace-nowrap text-right text-sm dark:text-gray-400">
                                            @if ($item->payment_method == 'due' && user_can('Update Order'))
                                                <x-secondary-button wire:click='showPayment({{ $order->id }})'>@lang('modules.order.addPayment')</x-secondary-button>
                                            @elseif ($order->status == 'pending_verification' && user_can('Update Order'))
                                                <x-secondary-button class="me-1" wire:click="paymentReceived({{ $order->id }}, 'received')">
                                                    @lang('modules.order.confirmPayment')
                                                </x-secondary-button>
                                                <x-danger-button wire:click="paymentReceived({{ $order->id }}, 'not_received')">
                                                    @lang('modules.order.reportUnpaid')
                                                </x-danger-button>
                                            @else
                                                {{ $item->created_at->timezone(timezone())->translatedFormat('d M, Y h:i A') }}
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($order->order_type == 'delivery' && $order->delivery_address)
                    <div class="mt-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-1.5 font-semibold text-gray-800 dark:text-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/></svg>
                                @lang('modules.customer.address')
                            </div>

                            @if($order->customer_lat && $order->customer_lng && branch()->lat && branch()->lng)
                                <a href="https://www.google.com/maps/dir/?api=1&travelmode=two-wheeler&origin={{ branch()->lat }},{{ branch()->lng }}&destination={{ $order->customer_lat }},{{ $order->customer_lng }}"
                                    target="_blank"
                                    class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 flex items-center gap-1 text-sm transition-colors">
                                    <span>@lang('modules.order.viewOnMap')</span>
                                    <svg width="24" height="24" class="h-4 w-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-4m-8-2 8-8m0 0v5m0-5h-5"/></svg>
                                </a>
                            @endif
                        </div>

                        <div class="text-sm text-gray-600 dark:text-gray-300 p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-600">
                            {!! nl2br(e($order->delivery_address)) !!}
                        </div>
                    </div>
                @endif

            @endif
        </x-slot>

        <x-slot name="footer">
                        <x-secondary-button wire:click="$set('showOrderDetail', false)" wire:loading.attr="disabled">
                            {{ __('app.close') }}
                        </x-secondary-button>
        </x-slot>
    </x-right-modal>

    @if ($order)
        <x-dialog-modal wire:model.live="showTableModal" maxWidth="2xl">
            <x-slot name="title">
                @lang('modules.table.availableTables')
            </x-slot>

            <x-slot name="content">
                @livewire('pos.setTable')
            </x-slot>

            <x-slot name="footer">
                <x-button-cancel wire:click="$toggle('showTableModal')" wire:loading.attr="disabled" />
            </x-slot>
        </x-dialog-modal>

        <x-confirmation-modal wire:model="cancelOrderModal">
            <x-slot name="title">
                @lang('modules.order.cancelOrder')?
            </x-slot>

            <x-slot name="content">
                @lang('modules.order.cancelOrderMessage')
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('cancelOrderModal')" wire:loading.attr="disabled">
                    {{ __('app.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click='cancelOrder({{ $order->id }})'
                    wire:loading.attr="disabled">
                    @lang('modules.order.cancelOrder')
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>


        <x-confirmation-modal wire:model="deleteOrderModal">
            <x-slot name="title">
                @lang('modules.order.deleteOrder')?
            </x-slot>

            <x-slot name="content">
                @lang('modules.order.deleteOrderMessage')
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('deleteOrderModal')" wire:loading.attr="disabled">
                    {{ __('app.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click='deleteOrder({{ $order->id }})'
                    wire:loading.attr="disabled">
                    @lang('modules.order.deleteOrder')
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>

    @endif

</div>
