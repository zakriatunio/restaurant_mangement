<?php

namespace App\Livewire\Photo;

use Livewire\Component;
use App\Models\Table;

class PanoramaViewer extends Component
{
    public $table;
    public $showPanoramaModal = true;
    public $panoramaImage;
    public $regularImage;
    public $isHDR = false;
    public $tableId;
    public $hash;

    protected $listeners = ['showPanoramaView'];

    public function mount($table = null, $hash = null)
    {
        if ($hash) {
            $this->hash = $hash;
            $this->loadTableByHash($hash);
        } else {
            $this->tableId = $table;
            $this->loadTable($table);
        }
    }

    public function loadTableByHash($hash)
    {
        $this->table = Table::where('hash', $hash)->first();
        $this->loadPictures();
    }

    public function loadTable($tableId)
    {
        $this->table = Table::find($tableId);
        $this->loadPictures();
    }

    protected function loadPictures()
    {
        if ($this->table && $this->table->pictures) {
            // Handle both string and array formats
            $pictures = is_string($this->table->pictures) 
                ? json_decode($this->table->pictures, true) 
                : $this->table->pictures;

            if (is_array($pictures)) {
                $this->panoramaImage = $pictures['panorama'] ?? null;
                $this->regularImage = $pictures['regular'] ?? null;
                
                // Check if panorama is HDR
                if ($this->panoramaImage) {
                    $this->isHDR = strtolower(pathinfo($this->panoramaImage, PATHINFO_EXTENSION)) === 'hdr';
                }
            }
        }
    }

    public function showPanoramaView($tableId)
    {
        $this->loadTable($tableId);
        $this->showPanoramaModal = true;
    }

    public function closePanoramaModal()
    {
        $this->showPanoramaModal = false;
        $this->reset(['table', 'panoramaImage', 'regularImage', 'isHDR']);
    }

    public function render()
    {
        return view('livewire.photo.panorama-viewer')
            ->layout('layouts.app');
    }
} 