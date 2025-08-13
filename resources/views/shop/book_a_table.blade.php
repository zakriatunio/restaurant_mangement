@extends('layouts.guest')

@section('content')

<!-- Debug: Check if this page is loading -->
<div style="background: yellow; padding: 10px; margin: 10px; border: 2px solid red;">
    <h3>🔧 DEBUG: Page Loading Test</h3>
    <p>Restaurant: {{ $restaurant->name ?? 'Not found' }}</p>
    <p>Current URL: {{ request()->fullUrl() }}</p>
    <p>Time: {{ now() }}</p>
    <button onclick="alert('JavaScript is working!')" style="background: blue; color: white; padding: 5px; border: none; border-radius: 3px;">Test JS</button>
    <button onclick="console.log('Livewire:', window.Livewire)" style="background: green; color: white; padding: 5px; border: none; border-radius: 3px;">Test Livewire</button>
    <button onclick="
        const modal = document.getElementById('test-modal');
        console.log('Modal element:', modal);
        if (modal) {
            alert('Modal found in DOM! Style: ' + modal.style.display);
        } else {
            alert('Modal NOT found in DOM!');
        }
    " style="background: purple; color: white; padding: 5px; border: none; border-radius: 3px;">Check Modal</button>
</div>

<!-- Simple Livewire Test -->
@livewire('test-modal')

@livewire('shop.bookATable', ['restaurant' => $restaurant])

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection