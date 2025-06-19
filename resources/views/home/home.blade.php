@extends('layouts.app')

@section('content')
    <div class="bg-white-100 p-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold">Price Configurator</h1>
        </div>
        <livewire:product.product-list/>
    </div>
@endsection
