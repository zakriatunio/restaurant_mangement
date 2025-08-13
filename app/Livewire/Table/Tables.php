<?php

namespace App\Livewire\Table;

use App\Models\Area;
use App\Models\Table;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Tables extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $activeTable;
    public $areaID = null;
    public $showAddTableModal = false;
    public $showEditTableModal = false;
    public $confirmDeleteTableModal = false;
    public $filterAvailable = null;
    public $viewType = 'list';
    public $tempPictures = [];
    public $maxPictures = 4;
    public $gridRow = null;
    public $gridCol = null;
    public $gridWidth = 1;
    public $gridHeight = 1;
    public $area = null;
    // keep all your existing properties / traits
public $mapRows    = 10;   // max rows you want rendered
public $mapCols    = 12;   // max columns

    public function mount()
    {
        // Get the saved view type from session, default to 'list' if not set
        $this->viewType = session('table_view_type', 'list');
    }

    public function updatedViewType($value)
    {
        // Save the view type preference to session whenever it changes
        session(['table_view_type' => $value]);
    }

    public function updatedTempPictures()
    {
        $this->validate([
            'tempPictures.*' => 'image|max:2048', // 2MB Max
        ]);

        if (count($this->activeTable->pictures ?? []) + count($this->tempPictures) > $this->maxPictures) {
            $this->addError('tempPictures', 'Maximum ' . $this->maxPictures . ' pictures allowed.');
            return;
        }

        $pictures = $this->activeTable->pictures ?? [];
        foreach ($this->tempPictures as $picture) {
            $path = $picture->store('table-pictures', 'public');
            $pictures[] = $path;
        }

        $this->activeTable->update(['pictures' => $pictures]);
        $this->tempPictures = [];
        $this->activeTable->refresh();
    }

    public function removePicture($index)
    {
        if (isset($this->activeTable->pictures[$index])) {
            Storage::disk('public')->delete($this->activeTable->pictures[$index]);
            $pictures = $this->activeTable->pictures;
            unset($pictures[$index]);
            $pictures = array_values($pictures);
            $this->activeTable->update(['pictures' => $pictures]);
            $this->activeTable->refresh();
        }
    }

    #[On('refreshTables')]
    public function refreshTables()
    {
        $this->render();
    }

    #[On('hideAddTable')]
    public function hideAddTable()
    {
        $this->showAddTableModal = false;
    }

    #[On('hideEditTable')]
    public function hideEditTable()
    {
        $this->showEditTableModal = false;
        $this->tempPictures = [];
    }

    public function showEditTable($id)
    {
        $this->activeTable = Table::findOrFail($id);
        $this->showEditTableModal = true;
    }

    public function showTableOrder($id)
    {
        return $this->redirect(route('pos.show', $id), navigate: true);
    }

    public function showTableOrderDetail($id)
    {
        return $this->redirect(route('pos.order', [$id]), navigate: true);
    }

    public function submitForm()
    {
        $this->validate([
            'tableCode' => 'required|string|max:255',
            'seatingCapacity' => 'required|integer|min:1',
            'area' => 'required|integer|exists:areas,id',
            'tableStatus' => 'required|string',
            'gridRow' => 'nullable|integer|min:1',
            'gridCol' => 'nullable|integer|min:1',
            'gridWidth' => 'nullable|integer|min:1',
            'gridHeight' => 'nullable|integer|min:1',
        ]);

        Table::create([
            'table_code' => $this->tableCode,
            'seating_capacity' => $this->seatingCapacity,
            'area_id' => $this->area,
            'status' => $this->tableStatus,
            'grid_row' => $this->gridRow,
            'grid_col' => $this->gridCol,
            'grid_width' => $this->gridWidth,
            'grid_height' => $this->gridHeight,
            'branch_id' => auth()->user()->branch_id,
        ]);

        $this->reset(['tableCode', 'seatingCapacity', 'area', 'tableStatus', 'gridRow', 'gridCol', 'gridWidth', 'gridHeight']);
        $this->showAddTableModal = false;
        $this->dispatch('refreshTables');
        $this->alert('success', 'Table created successfully!');
    }

    public function getAllTableGridPositionsProperty()
    {
        $branchId = Auth::check() ? Auth::user()->branch_id : null;
        $query = Table::where('branch_id', $branchId)
            ->whereNotNull('grid_row')
            ->whereNotNull('grid_col');
        if ($this->area) {
            $query->where('area_id', $this->area);
        }
        return $query->get(['grid_row', 'grid_col', 'grid_width', 'grid_height', 'table_code'])->toArray();
    }

    public function render()
    {
        $query = Area::with(['tables' => function ($query) {
            if (!is_null($this->filterAvailable)) {
                return $query->where('available_status', $this->filterAvailable);
            }
        }, 'tables.activeOrder']);

        if (!is_null($this->areaID)) {
            $query = $query->where('id', $this->areaID);
        }

        $query = $query->get();

        return view('livewire.table.tables', [
            'tables' => $query,
            'areas' => Area::get(),
            'mapTables' => $this->mapTables,
            'allTableGridPositions' => $this->allTableGridPositions,
        ]);
    }
    public function getMapTablesProperty()
    {
        $branchId = Auth::check() ? Auth::user()->branch_id : null;
        return Table::where('branch_id', $branchId)
            ->whereNotNull('grid_row')
            ->whereNotNull('grid_col')
            ->get()
            ->groupBy('grid_row');
    }
}
