<div>
    <h1>Test Component</h1>
    <p>Show Payment Modal: {{ $showPaymentModal ? 'TRUE' : 'FALSE' }}</p>
    <button wire:click="$set('showPaymentModal', true)">Show Modal</button>
    
    @if($showPaymentModal)
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,0,0,0.8); z-index: 9999; display: flex; align-items: center; justify-content: center;">
        <div style="background: white; padding: 20px; border-radius: 10px;">
            <h2>Test Modal Works!</h2>
            <button wire:click="$set('showPaymentModal', false)">Close</button>
        </div>
    </div>
    @endif
</div>