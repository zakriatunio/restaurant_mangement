<?php

namespace App\Livewire\Shop;

use App\Models\Table;
use Livewire\Component;

class ViewTable extends Component
{
    public $table;

    public function mount(Table $table)
    {
        $this->table = $table;
    }

    public function render()
    {
        return view('livewire.shop.view-table');
    }
} 