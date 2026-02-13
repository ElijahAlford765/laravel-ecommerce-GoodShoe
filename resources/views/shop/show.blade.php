@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width:1100px;">

    <div class="row align-items-center g-5">

        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <div class="product-image-wrapper shadow-sm rounded-4 p-3 bg-white">
                <img src="{{ $product->image_url }}" 
                     alt="{{ $product->name }}" 
                     class="img-fluid rounded-3 product-image">
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <h2 class="fw-semibold mb-3">{{ $product->name }}</h2>

            <p class="text-muted mb-4">
                {{ $product->description }}
            </p>

            <h4 class="fw-bold mb-4">
                ${{ number_format($product->price, 2) }}
            </h4>

            @if($product->size)
                <p class="text-muted mb-3">
                    Size: {{ $product->size }}
                </p>
            @endif

            <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-dark px-5 py-2">
                    Add to Cart
                </button>
            </form>
        </div>

    </div>

</div>

<style>
.product-image-wrapper {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-image-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
}

.product-image {
    max-height: 400px;
    object-fit: cover;
}
</style>
@endsection
