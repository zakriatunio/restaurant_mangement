<div>
    @php
        $row = $gridRow ?? null;
        $col = $gridCol ?? null;
        $width = $gridWidth ?? 1;
        $height = $gridHeight ?? 1;
        $occupied = [];
        $overlap = false;
        $tableCodeMap = [];
        if (isset($allTableGridPositions)) {
            foreach ($allTableGridPositions as $t) {
                $tRow = $t['grid_row'] ?? 1;
                $tCol = $t['grid_col'] ?? 1;
                $tWidth = $t['grid_width'] ?? 1;
                $tHeight = $t['grid_height'] ?? 1;
                $code = $t['table_code'] ?? '';
                for ($r = $tRow; $r < $tRow + $tHeight; $r++) {
                    for ($c = $tCol; $c < $tCol + $tWidth; $c++) {
                        $occupied["$r-$c"] = true;
                        $tableCodeMap["$r-$c"] = $code;
                    }
                }
            }
        }
        // Check for overlap
        if ($row && $col) {
            for ($r = $row; $r < $row + ($height ?? 1); $r++) {
                for ($c = $col; $c < $col + ($width ?? 1); $c++) {
                    if (isset($occupied["$r-$c"])) {
                        $overlap = true;
                    }
                }
            }
        }
    @endphp
    <form wire:submit.prevent="submitForm">
        @csrf
        <div class="space-y-4">
            <div>
                <x-label for="area_id" :value="__('modules.table.chooseArea')" />
                <x-select id="area_id" class="mt-1 block w-full" wire:model="area">
                    <option value="">--</option>
                    @foreach ($areas as $item)
                    <option value="{{ $item->id }}">{{ $item->area_name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="area" class="mt-2" />
            </div>

            <div>
                <x-label for="tableCode" value="{{ __('modules.table.tableCode') }}" />
                <x-input id="tableCode" class="block mt-1 w-full" type="text" placeholder="{{ __('placeholders.tableCodePlaceholder') }}" wire:model='tableCode' />
                <x-input-error for="tableCode" class="mt-2" />
            </div>

            <div>
                <x-label for="seatingCapacity" value="{{ __('modules.table.seatingCapacity') }}" />
                <x-input id="seatingCapacity" class="block mt-1 w-full" type="number" step='1' min='0' placeholder="{{ __('placeholders.tableSeatPlaceholder') }}" wire:model='seatingCapacity' />
                <x-input-error for="seatingCapacity" class="mt-2" />
            </div>

            <div>
                <x-label for="status" value="{{ __('app.status') }}" />
                <ul class="flex w-full gap-4 mt-1">
                    <li>
                        <input type="radio" id="typeActive"  value="active" class="hidden peer"
                            wire:model='tableStatus'>
                        <label for="typeActive"
                            class="inline-flex items-center justify-between p-2 text-gray-600 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-green-600 peer-checked:border-green-600 peer-checked:text-gray-900 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 text-sm font-medium">
                            @lang('app.active')
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="typeInactive" value="inactive" class="hidden peer"
                            wire:model='tableStatus' />
                        <label for="typeInactive"
                            class="inline-flex items-center justify-between p-2 text-gray-600 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-red-600 peer-checked:border-red-600 peer-checked:text-gray-900 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700 text-sm font-medium">
                            @lang('app.inactive')
                        </label>
                    </li>
                </ul>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <x-label for="grid_row" value="Grid Row (vertical position)" />
                    <x-input id="grid_row" class="block mt-1 w-full" type="number" min="1" wire:model="gridRow" />
                    <x-input-error for="gridRow" class="mt-2" />
                </div>
                <div>
                    <x-label for="grid_col" value="Grid Column (horizontal position)" />
                    <x-input id="grid_col" class="block mt-1 w-full" type="number" min="1" wire:model="gridCol" />
                    <x-input-error for="gridCol" class="mt-2" />
                </div>
                <div>
                    <x-label for="grid_width" value="Grid Width (how many columns this table spans)" />
                    <x-input id="grid_width" class="block mt-1 w-full" type="number" min="1" wire:model="gridWidth" />
                    <x-input-error for="gridWidth" class="mt-2" />
                </div>
                <div>
                    <x-label for="grid_height" value="Grid Height (how many rows this table spans)" />
                    <x-input id="grid_height" class="block mt-1 w-full" type="number" min="1" wire:model="gridHeight" />
                    <x-input-error for="gridHeight" class="mt-2" />
                </div>
            </div>
            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                <strong>What do these mean?</strong><br>
                <ul class="list-disc ml-5">
                    <li><b>Row</b>: Vertical position (top to bottom) in the seat map grid.</li>
                    <li><b>Column</b>: Horizontal position (left to right) in the seat map grid.</li>
                    <li><b>Width</b>: How many columns the table will span (default: 1).</li>
                    <li><b>Height</b>: How many rows the table will span (default: 1).</li>
                </ul>
            </div>
            <!-- Live Preview -->
            <div class="mt-6">
                <div class="mb-2 font-semibold text-sm">Live Table Map Preview</div>
                <div class="overflow-x-auto">
                    <div class="grid gap-1 bg-gray-100 dark:bg-gray-800 p-2 rounded-lg"
                        style="grid-template-columns: repeat(8, minmax(24px, 1fr)); width: 320px; height: 160px;">
                        @for ($r = 1; $r <= 4; $r++)
                            @for ($c = 1; $c <= 8; $c++)
                                @php
                                    $cellKey = "$r-$c";
                                    $isOccupied = isset($occupied[$cellKey]);
                                    $isNewTable = $row && $col && $r >= $row && $r < ($row + ($height ?? 1)) && $c >= $col && $c < ($col + ($width ?? 1));
                                    $isOverlap = $isNewTable && $isOccupied;
                                @endphp
                                <div class="flex items-center justify-center h-8 w-8 rounded text-xs font-bold
                                    {{ $isOverlap ? 'bg-red-500 text-white animate-pulse' : ($isNewTable ? 'bg-green-500 text-white' : ($isOccupied ? 'bg-yellow-400 text-gray-900' : 'bg-white border')) }}">
                                    @if($isOccupied)
                                        {{ $tableCodeMap[$cellKey] ?? '' }}
                                    @elseif($isNewTable)
                                        T
                                    @endif
                                </div>
                            @endfor
                        @endfor
                    </div>
                    <div class="text-xs text-gray-400 mt-1">
                        <span class="inline-block w-3 h-3 bg-green-500 mr-1 align-middle"></span> New Table Position
                        <span class="inline-block w-3 h-3 bg-yellow-400 mx-2 align-middle"></span> Occupied by Existing Table
                        <span class="inline-block w-3 h-3 bg-red-500 mx-2 align-middle"></span> Overlap (not allowed)
                    </div>
                </div>
                @if($overlap)
                    <div class="mt-2 text-sm text-red-600 font-semibold">Error: The selected position overlaps with an existing table. Please choose a different position.</div>
                @endif
            </div>
        </div>

        <div class="flex w-full pb-4 space-x-4 mt-6">
            <x-button :disabled="$overlap">@lang('app.save')</x-button>
            <x-button-cancel  wire:click="$dispatch('hideAddTable')" wire:loading.attr="disabled">@lang('app.cancel')</x-button-cancel>
        </div>
    </form>
    <button wire:click="submitForm" type="button">Test Submit</button>
</div>
