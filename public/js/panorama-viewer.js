class PanoramaViewer {
    constructor(container, options = {}) {
        this.container = container;
        this.options = {
            image: options.image || '',
            width: options.width || '100%',
            height: options.height || '500px',
            autoRotate: options.autoRotate || false,
            autoRotateSpeed: options.autoRotateSpeed || 0.5,
            ...options
        };

        this.viewer = null;
        this.panorama = null;
        this.init();
    }

    init() {
        try {
            // Create container for the viewer
            this.viewerContainer = document.createElement('div');
            this.viewerContainer.style.width = this.options.width;
            this.viewerContainer.style.height = this.options.height;
            this.container.appendChild(this.viewerContainer);

            // Initialize Panolens viewer with updated options
            this.viewer = new PANOLENS.Viewer({
                container: this.viewerContainer,
                autoRotate: this.options.autoRotate,
                autoRotateSpeed: this.options.autoRotateSpeed,
                controlBar: true,
                enableReticle: false, // Disable reticle to avoid initialization error
                enableZoom: true,
                enableFullscreen: true,
                cameraFov: 90
            });

            // Load panorama
            this.loadPanorama();
        } catch (error) {
            console.error('Error initializing panorama viewer:', error);
            this.showError();
        }
    }

    loadPanorama() {
        try {
            const imageUrl = this.options.image;
            if (!imageUrl) {
                console.error('No image URL provided');
                this.showError();
                return;
            }

            // Check if it's an HDR file
            if (imageUrl.toLowerCase().endsWith('.hdr')) {
                this.panorama = new PANOLENS.HDRPanorama(imageUrl);
            } else {
                this.panorama = new PANOLENS.ImagePanorama(imageUrl);
            }

            // Add event listeners
            this.panorama.addEventListener('load', () => {
                console.log('Panorama loaded successfully');
            });

            this.panorama.addEventListener('error', (error) => {
                console.error('Error loading panorama:', error);
                this.showError();
            });

            // Add panorama to viewer
            this.viewer.add(this.panorama);
        } catch (error) {
            console.error('Error loading panorama:', error);
            this.showError();
        }
    }

    showError() {
        // Create error message element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'w-full h-full flex items-center justify-center bg-gray-100';
        errorDiv.innerHTML = `
            <div class="text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <p class="text-gray-500 text-lg">Error loading panorama view</p>
            </div>
        `;

        // Replace viewer container with error message
        if (this.viewerContainer && this.viewerContainer.parentNode) {
            this.viewerContainer.parentNode.replaceChild(errorDiv, this.viewerContainer);
        }
    }

    destroy() {
        try {
            if (this.viewer) {
                this.viewer.dispose();
                this.viewer = null;
            }
            if (this.panorama) {
                this.panorama.dispose();
                this.panorama = null;
            }
            if (this.viewerContainer && this.viewerContainer.parentNode) {
                this.viewerContainer.parentNode.removeChild(this.viewerContainer);
            }
        } catch (error) {
            console.error('Error destroying panorama viewer:', error);
        }
    }
} 