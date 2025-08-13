<div>
    <!-- Panorama Viewer Modal -->
    <div x-data="{ show: @entangle('showPanoramaModal') }"
         x-show="show"
         x-cloak
         class="fixed inset-0 z-60 overflow-y-auto"
         aria-labelledby="modal-title"
         role="dialog"
         aria-modal="true">
        
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"></div>

        <!-- Modal panel -->
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-6xl sm:p-6">
                <!-- Close button -->
                <div class="absolute right-0 top-0 pr-4 pt-4">
                    <button wire:click="closePanoramaModal" type="button" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Panorama Viewer -->
                <div class="mt-3 text-center sm:mt-0 sm:text-left">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4" id="modal-title">
                        {{ __('app.table_pictures') }}
                    </h3>

                    @if($panoramaImage)
                        <div id="panorama-viewer" class="w-full h-[80vh] rounded-lg overflow-hidden"></div>
                    @elseif($regularImage)
                        <div class="w-full h-[80vh] rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $regularImage) }}" alt="Table View" class="w-full h-full object-contain">
                        </div>
                    @else
                        <div class="w-full h-[80vh] rounded-lg bg-gray-100 flex items-center justify-center">
                            <p class="text-gray-500">{{ __('app.no_pictures_available') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/panolens@0.12.0/build/panolens.min.js"></script>
    <script src="{{ asset('js/panorama-viewer.js') }}"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            let viewer = null;

            Livewire.on('showPanoramaView', () => {
                if (document.getElementById('panorama-viewer')) {
                    // Destroy existing viewer if any
                    if (viewer) {
                        viewer.destroy();
                    }

                    // Create new viewer
                    viewer = new PanoramaViewer(document.getElementById('panorama-viewer'), {
                        image: '{{ $panoramaImage ? asset("storage/" . $panoramaImage) : "" }}',
                        height: '80vh',
                        autoRotate: true,
                        autoRotateSpeed: 0.5
                    });
                }
            });

            // Clean up viewer when modal is closed
            Livewire.on('closePanoramaModal', () => {
                if (viewer) {
                    viewer.destroy();
                    viewer = null;
                }
            });
        });
    </script>
    @endpush
</div> 