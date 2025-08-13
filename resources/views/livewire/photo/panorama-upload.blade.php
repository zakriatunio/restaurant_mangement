<div class="w-full"
     x-data="{ 
        uploading: false,
        progress: 0,
        init() {
            this.$wire.on('uploadProgress', (progress) => {
                this.progress = progress;
                this.uploading = progress < 100;
            });
        }
     }"
     x-on:livewire-upload-start="uploading = true"
     x-on:livewire-upload-finish="uploading = false"
     x-on:livewire-upload-error="uploading = false">
    
    <!-- Error Message -->
    @if($error)
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ $error }}
        </div>
    @endif

    <!-- Upload Area -->
    <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
        <!-- Progress Bar -->
        <div x-show="uploading" class="w-full">
            <div class="relative pt-1">
                <div class="flex mb-2 items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                            @lang('modules.table.uploading')
                        </span>
                    </div>
                    <div class="text-right">
                        <span class="text-xs font-semibold inline-block text-indigo-600" x-text="progress + '%'">
                        </span>
                    </div>
                </div>
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                    <div class="transition-all duration-500 ease-out shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500"
                         :style="'width: ' + progress + '%'">
                    </div>
                </div>
            </div>
        </div>

        <!-- Upload Interface -->
        <div class="space-y-1 text-center" x-show="!uploading">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
                <label for="panoramaImage" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <span>@lang('modules.table.uploadPanorama')</span>
                    <input wire:model="panoramaImage" 
                           id="panoramaImage" 
                           type="file" 
                           class="sr-only" 
                           accept="image/*"
                           wire:loading.attr="disabled">
                </label>
                <p class="pl-1">@lang('modules.table.orDragAndDrop')</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF @lang('modules.table.upTo2GB')</p>
        </div>
    </div>

    <!-- Processing Indicator -->
    @if($isProcessing)
        <div class="mt-4 text-center">
            <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-white transition ease-in-out duration-150 cursor-not-allowed">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                @lang('modules.table.processing')
            </div>
        </div>
    @endif
</div> 