@extends('layouts.app')

@section('content')

    @livewire('order-products.order-products', [
        'orderID'            => $orderID,
    ])
    

@endsection