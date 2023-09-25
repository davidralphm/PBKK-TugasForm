@extends('products.base')

@section('title', 'Edit Product')

@section('content')

@section('heading', 'Edit Product')

<form action="/products/{{ $product->id }}" method="post" enctype="multipart/form-data" class="container p-4">
    {{ csrf_field() }}

    <input type="hidden" name="_method" value="PUT">

    <div class="mt-2 mb-2">
        <label for="name" class="form-label">Product Name</label>
        <input class="form-control" type="text" placeholder="Name" name="name" id="name"
            @if ($errors->has('name') || empty(old('name')))
                value="{{ $product->name }}"
            @else
                value="{{ old('name') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="category" class="form-label">Product Category</label>
        <select class="form-control" name="category" id="category">
            <option
                value=""
                disabled
            >
                Select Category...
            </option>
    
            @foreach ($categories as $category)
                <option
                    value="{{ $category }}"
    
                    @if ($errors->has('category') || empty(old('category')))
                        @if ($product->category == $category)
                            selected
                        @endif
                    @else
                        @if (old('category') == $category)
                            selected
                        @endif
                    @endif
                >
                    {{ $category }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-2 mb-2">
        <label for="price" class="form-label">Product Price</label>
        <input class="form-control" type="text" placeholder="Price" name="price" id="price"
            @if ($errors->has('price') || empty(old('price')))
                value="{{ $product->price }}"
            @else
                value="{{ old('price') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="stock" class="form-label">Product Stock</label>
        <input class="form-control" type="text" placeholder="Stock" name="stock" id="stock"
            @if ($errors->has('stock') || empty(old('stock')))
                value="{{ $product->stock }}"
            @else
                value="{{ old('stock') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="description" class="form-label">Product Description</label>
        <textarea rows="5" class="form-control" type="text" placeholder="Description" name="description" id="description">
        </textarea>
    </div>

    <div class="mt-2 mb-5">
        <label for="image" class="form-label">Product Image</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <input class="btn btn-primary" type="submit" value="Save Changes">
</form>

<script>
    const description = document.getElementById('description');

    @if ($errors->has('description') || empty(old('description')))
        description.textContent = "{{ htmlspecialchars($product->description) }}";
    @else
        description.textContent = "{{ htmlspecialchars(old('description')) }}";
    @endif
</script>

@endsection