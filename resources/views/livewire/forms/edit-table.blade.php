<div>
    <form wire:submit="submitForm" class="space-y-4">
        @csrf
            <div>
            <x-label for="table_code" :value="__('modules.table.tableCode')" />
            <x-input wire:model="table_code" id="table_code" type="text" class="mt-1 block w-full" required />
            <x-input-error for="table_code" class="mt-2" />
            </div>

            <div>
            <x-label for="seating_capacity" :value="__('modules.table.seatingCapacity')" />
            <x-input wire:model="seating_capacity" id="seating_capacity" type="number" class="mt-1 block w-full" required min="1" />
            <x-input-error for="seating_capacity" class="mt-2" />
            </div>

            <div>
            <x-label for="area_id" :value="__('modules.table.area')" />
            <x-select wire:model="area_id" id="area_id" class="mt-1 block w-full" required>
                <option value="">@lang('app.select') @lang('modules.table.area')</option>
                @foreach(\App\Models\Area::all() as $area)
                    <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                @endforeach
            </x-select>
            <x-input-error for="area_id" class="mt-2" />
            </div>

            <div>
            <x-label for="tableAvailability" :value="__('modules.table.tableAvailability')" />
            <x-select wire:model="tableAvailability" id="tableAvailability" class="mt-1 block w-full" required>
                    <option value="available">@lang('modules.table.available')</option>
                    <option value="running">@lang('modules.table.running')</option>
                    <option value="reserved">@lang('modules.table.reserved')</option>
                </x-select>
                <x-input-error for="tableAvailability" class="mt-2" />
            </div>

            <div>
            <x-label for="status" :value="__('app.status')" />
            <x-select wire:model="status" id="status" class="mt-1 block w-full" required>
                <option value="active">@lang('app.active')</option>
                <option value="inactive">@lang('app.inactive')</option>
            </x-select>
            <x-input-error for="status" class="mt-2" />
        </div>

        <!-- Table Pictures Section -->
        <div class="mt-4">
            <x-label :value="__('modules.table.pictures')" />
            
            <!-- Current Pictures -->
            @if(count($activeTable->pictures ?? []) > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                    @if($activeTable->getPanoramaPicture())
                        <div class="relative group col-span-2 md:col-span-4">
                            <img src="{{ Storage::url($activeTable->getPanoramaPicture()) }}" alt="Panorama picture" class="w-full h-64 object-cover rounded-lg">
                            <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded text-sm">
                                @lang('modules.table.panoramaView')
                            </div>
                            <button type="button" wire:click="removePicture({{ array_search($activeTable->getPanoramaPicture(), array_column($activeTable->pictures, 'path')) }})" class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    @foreach($activeTable->getRegularPictures() as $index => $picture)
                        <div class="relative group">
                            <img src="{{ Storage::url($picture['path']) }}" alt="Table picture" class="w-full h-32 object-cover rounded-lg">
                            <button type="button" wire:click="removePicture({{ $index }})" class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Upload New Pictures -->
            @if(count($activeTable->getRegularPictures()) < $maxPictures)
                <div class="mt-4">
                    <div class="flex items-center mb-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="isPanorama" class="form-checkbox h-5 w-5 text-indigo-600">
                            <span class="ml-2 text-sm text-gray-700">@lang('modules.table.uploadAsPanorama')</span>
                        </label>
                    </div>

                    @if($isPanorama)
                        <livewire:photo.panorama-upload :table="$activeTable" />
                    @else
                        <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="tempPictures" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>@lang('modules.table.uploadPictures')</span>
                                        <input wire:model="tempPictures" 
                                               id="tempPictures" 
                                               type="file" 
                                               class="sr-only" 
                                               accept="image/*">
                        </label>
                                    <p class="pl-1">@lang('modules.table.orDragAndDrop')</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF @lang('modules.table.upTo2GB')</p>
                            </div>
                        </div>
                    @endif
                    @error('tempPictures.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            @endif
        </div>

        <div class="flex justify-end gap-2">
            <x-secondary-button type="button" wire:click="$dispatch('hideEditTable')">
                @lang('app.cancel')
            </x-secondary-button>
            <x-button type="submit">
                @lang('app.update')
            </x-button>
        </div>
    </form>

    <x-confirmation-modal wire:model="confirmDeleteTableModal">
        <x-slot name="title">
            @lang('modules.table.deleteTable')?
        </x-slot>

        <x-slot name="content">
            @lang('modules.table.deleteTableMessage')
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmDeleteTableModal')" wire:loading.attr="disabled">
                {{ __('app.cancel') }}
            </x-secondary-button>

            @if ($activeTable)
            <x-danger-button class="ml-3" wire:click='deleteTable' wire:loading.attr="disabled">
                {{ __('app.delete') }}
            </x-danger-button>
            @endif
         </x-slot>
    </x-confirmation-modal>

</div>
