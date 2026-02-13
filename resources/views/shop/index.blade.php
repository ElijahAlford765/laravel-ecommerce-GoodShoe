@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="text-center fw-semibold mb-4">Our Products</h2>

    <!-- Search Bar -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-6">
            <form method="GET" action="{{ route('shop.index') }}">
                <div class="input-group shadow-sm rounded-pill overflow-hidden">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           class="form-control border-0 px-4"
                           placeholder="Search shoes, brands, categories...">

                    <button class="btn btn-dark px-4" type="submit">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4 justify-content-center">
        @forelse($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 shadow-sm product-card">

                <a href="{{ route('shop.show',$product->product_id) }}" class="text-decoration-none text-dark">
                    <div class="overflow-hidden rounded-top">
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->name }}" 
                             class="card-img-top product-image">
                    </div>

                    <div class="card-body text-center">
                        <h6 class="fw-semibold mb-2">{{ $product->name }}</h6>
                        <p class="fw-bold mb-1">${{ number_format($product->price,2) }}</p>

                        @if($product->size)
                            <p class="text-muted small mb-2">Size: {{ $product->size }}</p>
                        @endif
                    </div>
                </a>

                <div class="card-footer bg-white border-0 text-center pb-4">
                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-dark btn-sm px-4">
                            Add to Cart
                        </button>
                    </form>
                </div>

            </div>
        </div>
        @empty
        <div class="text-center mt-5">
            <p class="text-muted fs-5">No products found.</p>
        </div>
        @endforelse
    </div>

</div>

<style>
.product-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    border-radius: 12px;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.product-image {
    height: 220px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card:hover .product-image {
    transform: scale(1.05);
}
</style>
@endsection
