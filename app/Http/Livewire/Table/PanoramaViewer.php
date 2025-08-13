<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\Table;

class PanoramaViewer extends Component
{
    public $table;
    public $showPanoramaModal = false;
    public $panoramaImage;
    public $regularImage;
    public $isHDR = false;

    protected $listeners = ['showPanoramaView'];

    public function showPanoramaView($tableId)
    {
        $this->table = Table::find($tableId);
        
        if ($this->table && $this->table->pictures) {
            $pictures = json_decode($this->table->pictures, true);
            $this->panoramaImage = $pictures['panorama'] ?? null;
            $this->regularImage = $pictures['regular'] ?? null;
            
            // Check if panorama is HDR
            if ($this->panoramaImage) {
                $this->isHDR = strtolower(pathinfo($this->panoramaImage, PATHINFO_EXTENSION)) === 'hdr';
            }
        }

        $this->showPanoramaModal = true;
    }

    public function closePanoramaModal()
    {
        $this->showPanoramaModal = false;
        $this->reset(['table', 'panoramaImage', 'regularImage', 'isHDR']);
    }

    public function render()
    {
        return view('livewire.table.panorama-viewer');
    }
} 