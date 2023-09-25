@extends('products.base')

@section('title', 'Create Product')

@section('content')

@section('heading', 'Create Product')

<form action="/products" method="post" enctype="multipart/form-data" class="container p-4">
    {{ csrf_field() }}

    <div class="mt-2 mb-2">
        <label for="name" class="form-label">Product Name</label>
        <input class="form-control" type="text" placeholder="Name" name="name" id="name"
            @if (!$errors->has('name'))
                value="{{ old('name') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="category" class="form-label">Product Category</label>
        <select name="category" id="name" class="form-control">
            <option
                value=""
                disabled
                
                @if (old('category') == "")
                    selected
                @endif
            >
                Select one...
            </option>
            
            @foreach ($categories as $category)
                <option
                    value="{{ $category }}"
                    
                    @if (!$errors->has('category'))
                        @if (old('category' == $category))
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
            @if (!$errors->has('price'))
                value="{{ old('price') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="stock" class="form-label">Product Stock</label>
        <input class="form-control" type="text" placeholder="Stock" name="stock" id="stock"
            @if (!$errors->has('stock'))
                value="{{ old('stock') }}"
            @endif
        >
    </div>

    <div class="mt-2 mb-2">
        <label for="description" class="form-label">Product Description</label>
        <textarea rows="5" class="form-control" type="text" placeholder="Description" name="description" id="description"></textarea>
    </div>

    <div class="mt-2 mb-5">
        <label for="image" class="form-label">Product Image</label>
        <input class="form-control" type="file" name="image" id="image">
    </div>

    <input class="btn btn-primary" type="submit" value="Add Product">
</form>

<script>
    const description = document.getElementById('description');

    @if (!$errors->has('description'))
        description.textContent = "{{ htmlspecialchars(old('description')) }}";
    @endif
</script>

@endsection