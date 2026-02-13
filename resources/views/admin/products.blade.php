@extends('app')

@section('content')
<div class="container mt-4">

    <ul class="nav nav-tabs" id="productTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="list-tab" data-bs-toggle="tab"
                    data-bs-target="#list" type="button" role="tab">
                Product List
            </button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="create-tab" data-bs-toggle="tab"
                    data-bs-target="#create" type="button" role="tab">
                Create Product
            </button>
        </li>

        @if(isset($editProduct))
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="edit-tab" data-bs-toggle="tab"
                    data-bs-target="#edit" type="button" role="tab">
                Edit Product
            </button>
        </li>
        @endif
    </ul>

    <div class="tab-content mt-3">

        <div class="tab-pane fade show active" id="list" role="tabpanel">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Products</h3>
                <button class="btn btn-primary" onclick="openCreateTab()">
                    Create New
                </button>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price ($)</th>
                        <th>Created</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->product_id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')"
                                        class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No Products Found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="create" role="tabpanel">
            <h3>Create Product</h3>
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                </div>
                <button class="btn btn-success">Create</button>
            </form>
        </div>

        @if(isset($editProduct))
        <div class="tab-pane fade" id="edit" role="tabpanel">
            <h3>Edit Product</h3>
            <form action="{{ route('admin.products.update', $editProduct->product_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $editProduct->name) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Price ($)</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $editProduct->price) }}">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
        @endif

    </div>
</div>

<script>
    function openCreateTab() {
        document.querySelector('#create-tab').click();
    }

    @if(isset($editProduct))
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelector('#edit-tab').click();
    });
    @endif
</script>
@endsection
