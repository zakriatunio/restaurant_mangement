<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ShopDesktopNavigation extends Component
{
    protected $listeners = ['setCustomer' => '$refresh'];

    public $orderItemCount = 0;
    public $restaurant;
    public $shopBranch;
    public $showWaiterButtonCheck = false;

    #[On('updateCartCount')]
    public function updateCartCount($count)
    {
        $this->orderItemCount = $count;
    }

    public function mount()
    {
        $this->showWaiterButtonCheck = $this->checkWaiterButtonStatus();
    }

    public function checkWaiterButtonStatus()
    {
        $this->dispatch('refreshComponent');

        if (!$this->restaurant->is_waiter_request_enabled || !$this->restaurant->is_waiter_request_enabled_on_desktop) {
            return false;
        }

        $cameFromQR = request()->query('hash') === $this->restaurant->hash || request()->boolean('from_qr');

        if ($this->restaurant->is_waiter_request_enabled_open_by_qr && !$cameFromQR) {
            return false;
        }

        return true;
    }

    private function getPackageModules($restaurant)
    {
        if (!$restaurant || !$restaurant->package) {
            return [];
        }

        $modules = $restaurant->package->modules->pluck('name')->toArray();
        $additionalFeatures = json_decode($restaurant->package->additional_features ?? '[]', true);

        return array_merge($modules, $additionalFeatures);
    }

    public function render()
    {
        $modules = $this->getPackageModules($this->restaurant);
        return view('livewire.shop-desktop-navigation', ['modules' => $modules]);
    }

}
