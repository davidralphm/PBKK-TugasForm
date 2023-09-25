@extends('products.base')

@section('title', 'Product List')

@section('content')

@section('heading', 'Product List')

@if (count($products) == 0)
    <b>There are no products to show</b>
    <b>Click <a href="{{ URL::to('products/create') }}">here</a> to create one.</b>
@else
    <div class="row p-3">
        @foreach ($products as $key => $value)
            <div class="card w-25 p-2 col-sm-3">
                <img src="/storage/uploads/{{ $value->image }}" alt="{{ $value->name }} image" class="card-image-top">
    
                <div class="card-body">
                    <h5 class="card-title mt-1 mb-3">{{ $value->name }}</h5>
    
                    <p class="card-text">{{ $value->category }}</p>
                    <p class="card-text">${{ $value->price }}</p>
                    <p class="card-text">{{ $value->stock }}</p>
    
                    <a href="/products/{{ $value->id }}" class="btn btn-primary">View</a>
                    <a href="/products/{{ $value->id }}/edit" class="btn btn-info text-light">Edit</a>
                    <a href="/products/{{ $value->id }}/edit" class="btn btn-danger">Delete</a>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection