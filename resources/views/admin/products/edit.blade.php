@extends('layouts.app')

@section('content')
<h1 style="text-align:center; margin-bottom:20px;">Edit Product</h1>

<form action="{{ route('admin.products.update', $product->product_id) }}" method="POST">
    @csrf
    @method('PUT')
    <div style="margin-bottom:10px;">
        <label>SKU:</label>
        <input type="text" name="sku" value="{{ $product->sku }}" required style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Description:</label>
        <textarea name="description" style="width:100%; padding:6px;">{{ $product->description }}</textarea>
    </div>
    <div style="margin-bottom:10px;">
        <label>Price:</label>
        <input type="number" step="0.01" name="price" value="{{ $product->price }}" required style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Image URL:</label>
        <input type="text" name="image_url" value="{{ $product->image_url }}" style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Brand:</label>
        <input type="text" name="brand" value="{{ $product->brand }}" style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Category:</label>
        <input type="text" name="category" value="{{ $product->category }}" style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Size:</label>
        <input type="text" name="size" value="{{ $product->size }}" style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Color:</label>
        <input type="text" name="color" value="{{ $product->color }}" style="width:100%; padding:6px;">
    </div>
    <div style="margin-bottom:10px;">
        <label>Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}" style="width:100%; padding:6px;">
    </div>
    <button type="submit" style="background-color:#007bff; color:white; padding:8px 12px; border-radius:5px; border:none;">Update Product</button>
</form>
@endsection
