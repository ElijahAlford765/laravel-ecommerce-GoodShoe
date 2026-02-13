@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width:900px;">

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-5">

            <h3 class="fw-semibold mb-4 text-center">Add New Product</h3>

            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" required class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" required class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" name="price" required class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Stock</label>
                        <input type="number" name="stock" value="0" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Size</label>
                        <input type="text" name="size" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Brand</label>
                        <input type="text" name="brand" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Color</label>
                        <input type="text" name="color" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Image URL</label>
                        <input type="text" name="image_url" class="form-control">
                    </div>

                </div>

                <div class="text-end mt-5">
                    <a href="{{ route('admin.products.index') }}" 
                       class="btn btn-outline-secondary me-2">
                        Cancel
                    </a>

                    <button type="submit" 
                            class="btn btn-dark px-4">
                        Add Product
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
