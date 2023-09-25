@extends('products.base')

@section('title', $product->name)

@section('content')
    <div class="container p-5">
        <div class="row">
            <div class="col-md-4">
                <img class="container-fluid" src="/storage/uploads/{{ $product->image }}" alt="{{ $product->name }} image">
            </div>
            
            <div class="col-md-8">
                <h4>{{ $product->name }}</h4>
                <h6 class="text-secondary">{{ $product->category }}</h6>

                <h4 class="mt-5">${{ $product->price }}</h4>
                <h6 class="text-secondary">{{ $product->stock }} item(s) available</h6>

                <p class="mt-5">{{ $product->description }}</p>

                <div class="mt-4">
                    <a href="/products/{{ $product->id }}/edit" class="btn btn-primary">Edit</a>
                    <a href="/products/{{ $product->id }}/delete" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection