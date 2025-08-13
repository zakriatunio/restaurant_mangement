<div>
    <div style="background: cyan; padding: 20px; margin: 20px; border: 3px solid blue;">
        <h2>🧪 SIMPLE LIVEWIRE TEST</h2>
        <p>Modal State: {{ $showModal ? 'OPEN' : 'CLOSED' }}</p>
        <button wire:click="showTestModal" style="background: green; color: white; padding: 10px; margin: 5px; border: none; border-radius: 5px;">
            Show Modal
        </button>
        <button wire:click="hideTestModal" style="background: red; color: white; padding: 10px; margin: 5px; border: none; border-radius: 5px;">
            Hide Modal
        </button>
    </div>

    @if($showModal)
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,0,255,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">
        <div style="background: white; padding: 30px; border-radius: 10px; border: 5px solid magenta;">
            <h1 style="color: magenta; font-size: 30px;">🎉 MODAL WORKS! 🎉</h1>
            <p>If you can see this, Livewire modals are working!</p>
            <button wire:click="hideTestModal" style="background: red; color: white; padding: 15px; border: none; border-radius: 5px; font-size: 16px;">
                Close Modal
            </button>
        </div>
    </div>
    @endif
</div>