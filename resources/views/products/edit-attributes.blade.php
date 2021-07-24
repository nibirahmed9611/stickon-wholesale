@extends('layouts.app')

@section('content')

    @livewire('product.edit-attribute',['productID'=>$id])
    

@endsection