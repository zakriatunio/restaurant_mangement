<?php

namespace App\Livewire\Forms;

use App\Models\Area;
use App\Models\Table;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Helper\Files;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class EditTable extends Component
{
    use LivewireAlert, WithFileUploads;

    public $activeTable;
    public $table_code;
    public $seating_capacity;
    public $area_id;
    public $status;
    public $tableAvailability;
    public $confirmDeleteTableModal = false;
    public $tempPictures = [];
    public $maxPictures = 4;
    public $isPanorama = false;
    public $uploadProgress = 0;

    public function mount(Table $activeTable)
    {
        $this->activeTable = $activeTable;
        $this->table_code = $activeTable->table_code;
        $this->seating_capacity = $activeTable->seating_capacity;
        $this->area_id = $activeTable->area_id;
        $this->status = $activeTable->status;
        $this->tableAvailability = $activeTable->available_status;
    }

    public function updatedTempPictures()
    {
        $this->validate([
            'tempPictures.*' => 'image|max:2048000', // 2GB in KB (2048 * 1024)
        ]);

        if (count($this->activeTable->getRegularPictures()) + count($this->tempPictures) > $this->maxPictures) {
            $this->addError('tempPictures', 'Maximum ' . $this->maxPictures . ' pictures allowed.');
            return;
        }

        foreach ($this->tempPictures as $picture) {
            $path = $picture->store('table-pictures', 'public');
            $this->activeTable->addPicture($path, false);
        }

        $this->tempPictures = [];
        $this->isPanorama = false;
        $this->activeTable->refresh();
    }

    #[On('panorama-uploaded')]
    public function handlePanoramaUploaded()
    {
        $this->isPanorama = false;
        $this->activeTable->refresh();
    }

    public function uploadProgress($progress)
    {
        $this->uploadProgress = $progress;
    }

    public function removePicture($index)
    {
        $this->activeTable->removePicture($index);
        $this->activeTable->refresh();
    }

    public function submitForm()
    {
        $this->validate([
            'table_code' => 'required|string|max:191',
            'seating_capacity' => 'required|integer|min:1',
            'area_id' => 'required|exists:areas,id',
            'status' => 'required|in:active,inactive',
            'tableAvailability' => 'required|in:available,running,reserved',
        ]);

        $doQrCode = false;
        if ($this->activeTable->table_code !== $this->table_code) {
            $doQrCode = true;
        }

        $this->activeTable->update([
            'table_code' => $this->table_code,
            'seating_capacity' => $this->seating_capacity,
            'area_id' => $this->area_id,
            'status' => $this->status,
            'available_status' => $this->tableAvailability,
        ]);

        if ($doQrCode) {
            $this->activeTable->generateQrCode();
        }

        $this->dispatch('refreshTables');
        $this->dispatch('hideEditTable');

        $this->alert('success', __('messages.tableUpdated'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'cancelButtonText' => __('app.close')
        ]);
    }

    public function showDeleteTable()
    {
        $this->confirmDeleteTableModal = true;
    }

    public function deleteTable()
    {
        Table::destroy($this->activeTable->id);

        $this->redirect(route('tables.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.forms.edit-table');
    }
}
