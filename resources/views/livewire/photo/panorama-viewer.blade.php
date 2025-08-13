<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panorama Viewer</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Photo Sphere Viewer CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.min.css"/>
    
    <style>
        html, body {
            margin: 0;
            overflow: hidden;
            height: 100%;
            width: 100%;
        }
        #viewer {
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
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
                            <div id="panorama-viewer" class="w-full h-[80vh] rounded-lg overflow-hidden">
                                <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                    <div class="text-center">
                                        <svg class="animate-spin h-8 w-8 text-gray-400 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <p class="text-gray-500">{{ __('app.loading_panorama') }}</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($regularImage)
                            <div class="w-full h-[80vh] rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($regularImage) }}" alt="Table View" class="w-full h-full object-contain">
                            </div>
                        @else
                            <div class="w-full h-[80vh] rounded-lg bg-gray-100 flex flex-col items-center justify-center p-6">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-500 text-lg mb-2">{{ __('app.no_pictures_available') }}</p>
                                <p class="text-gray-400 text-sm">{{ __('app.contact_restaurant_for_pictures') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/three@0.105.0/build/three.min.js"></script>
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
                        const imageUrl = '{{ $panoramaImage ? Storage::url($panoramaImage) : "" }}';
                        console.log('Loading panorama image:', imageUrl);

                        viewer = new PanoramaViewer(document.getElementById('panorama-viewer'), {
                            image: imageUrl,
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
</body>
</html> 