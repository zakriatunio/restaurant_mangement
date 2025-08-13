@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if($panoramaImage)
                    <div id="panorama-viewer" class="w-full h-[80vh] rounded-lg overflow-hidden"></div>
                @elseif($regularImage)
                    <div class="w-full h-[80vh] rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $regularImage) }}" alt="Table View" class="w-full h-full object-contain">
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

@if($panoramaImage)
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/panolens@0.12.0/build/panolens.min.js"></script>
    <script src="{{ asset('js/panorama-viewer.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageUrl = '{{ asset("storage/" . $panoramaImage) }}';
            console.log('Panorama Image URL:', imageUrl);

            const viewer = new PanoramaViewer(document.getElementById('panorama-viewer'), {
                image: imageUrl,
                height: '80vh',
                autoRotate: true,
                autoRotateSpeed: 0.5
            });
        });
    </script>
    @endpush
@endif
@endsection 