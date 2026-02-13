@extends('app')

@section('content')


@if(isset($singleProduct))
<div class="container my-5">
    <a href="{{ route('shop.index') }}" class="btn btn-secondary mb-3">← Back to Products</a>

    <div class="card shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $singleProduct->image_url }}" 
                     class="img-fluid rounded-start"
                     alt="{{ $singleProduct->name }}">
            </div>

            <div class="col-md-8 p-4">
                <h2>{{ $singleProduct->name }}</h2>
                <p class="text-muted">{{ $singleProduct->description }}</p>

                <h4 class="text-success">${{ number_format($singleProduct->price, 2) }}</h4>

               
                <form action="{{ route('cart.add', $singleProduct) }}" method="POST" class="mt-3">
                    @csrf
                    <input type="number" name="quantity" value="1" min="1" class="form-control w-25 mb-2">
                    <button type="submit" class="btn btn-primary btn-lg">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>


@else
<div class="container my-5">
    <h1 class="mb-4">Shop Products</h1>

    <div class="row">
        @foreach($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $item->image_url }}" 
                         class="card-img-top" 
                         alt="{{ $item->name }}">

                    <div class="card-body d-flex flex-column">
                        <h5>{{ $item->name }}</h5>
                        <p class="text-muted">{{ Str::limit($item->description, 70) }}</p>

                        <h6 class="text-success mb-3">
                            ${{ number_format($item->price, 2) }}
                        </h6>

                        <a href="{{ route('shop.show', $item) }}" 
                           class="btn btn-outline-primary mt-auto">
                           View Product
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
