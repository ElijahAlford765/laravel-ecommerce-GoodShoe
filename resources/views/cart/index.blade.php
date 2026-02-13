@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width:1000px;">

    <h2 class="text-center fw-semibold mb-5">Your Cart</h2>

    @if($items->count())

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">Product</th>
                            <th>Size</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th class="text-end px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td class="px-4 fw-medium">
                                {{ $item->product->name }}
                            </td>

                            <td class="text-muted">
                                {{ $item->product->size ?? 'N/A' }}
                            </td>

                            <td>
                                <form action="{{ route('cart.update', $item->cart_item_id) }}" 
                                      method="POST" 
                                      class="d-flex align-items-center gap-2">
                                    @csrf
                                    <input type="number" 
                                           name="quantity" 
                                           min="1" 
                                           value="{{ $item->quantity }}" 
                                           class="form-control form-control-sm"
                                           style="width:70px;">
                                    <button type="submit" 
                                            class="btn btn-outline-secondary btn-sm">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <td class="fw-semibold">
                                ${{ number_format($item->price, 2) }}
                            </td>

                            <td class="text-end px-4">
                                <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-sm">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Checkout Button -->
    <div class="text-end mt-4">
        <a href="{{ route('checkout') }}" 
           class="btn btn-dark px-4 py-2">
           Proceed to Checkout
        </a>
    </div>

    @else

    <div class="text-center py-5">
        <p class="text-muted fs-5">Your cart is empty.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-outline-dark mt-3">
            Continue Shopping
        </a>
    </div>

    @endif

</div>
@endsection
