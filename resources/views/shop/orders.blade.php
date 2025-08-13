@extends('layouts.guest')

@section('content')

@livewire('shop.orders', ['restaurant' => $restaurant])

@livewire('customer.signup', ['restaurant' => $restaurant])

@endsection
