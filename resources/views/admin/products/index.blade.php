@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width:1100px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-semibold mb-0">Products</h3>
        <a href="{{ route('admin.products.create') }}" 
           class="btn btn-primary btn-sm">
           Add Product
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4">SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-end px-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td class="px-4 text-muted">{{ $product->sku }}</td>
                        <td class="fw-medium">{{ $product->name }}</td>
                        <td>${{ number_format($product->price,2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td class="text-end px-4">
                            <a href="{{ route('admin.products.edit', $product->product_id) }}" 
                               class="btn btn-outline-secondary btn-sm me-2">
                               Edit
                            </a>

                            <form action="{{ route('admin.products.destroy', $product->product_id) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Delete this product?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No products available.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
