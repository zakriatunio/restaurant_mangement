<?php

namespace App\Livewire\Photo;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Table;
use App\Models\TablePicture;

class PanoramaUpload extends Component
{
    use WithFileUploads;

    public Table $table;
    public $uploadProgress = 0;
    public $isProcessing = false;
    public $error = null;

    #[Rule('required|image|max:2048000')] // 2GB in KB (2048 * 1024)
    public $panoramaImage;

    public function mount(Table $table)
    {
        $this->table = $table;
    }

    public function updatedPanoramaImage()
    {
        try {
            $this->isProcessing = true;
            $this->error = null;
            
            // Validate the upload
            $this->validate([
                'panoramaImage' => 'required|image|max:2048000'
            ]);

            // Store the panorama image
            $path = $this->panoramaImage->store('table-panoramas', 'public');
            
            // Create panorama record
            $this->table->addPicture($path, true);

            // Reset state
            $this->panoramaImage = null;
            $this->uploadProgress = 0;
            $this->isProcessing = false;

            // Emit event for parent component
            $this->dispatch('panorama-uploaded');

        } catch (\Exception $e) {
            Log::error('Panorama upload failed: ' . $e->getMessage());
            $this->error = 'Failed to upload panorama. Please try again.';
            $this->isProcessing = false;
            $this->uploadProgress = 0;
        }
    }

    public function uploadProgress($progress)
    {
        $this->uploadProgress = $progress;
    }

    public function render()
    {
        return view('livewire.photo.panorama-upload');
    }
} 