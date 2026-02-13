@extends('layouts.app')

@section('content')
<h1>Order History</h1>

@if ($orders->isEmpty())
    <p>No orders have been placed yet.</p>
@else
    @php
        $lastOrderShipping = session('last_order_shipping');
        $lastOrderId = session('last_order_id');
    @endphp

    @foreach ($orders as $order)
        <div class="card p-3 mb-3">
            <h3>Order #{{ $order->order_id }}</h3>

            <p><strong>Customer:</strong> {{ $order->customer_name }}</p>
            <p><strong>Date:</strong> {{ $order->order_date }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>

            <h4>Items:</h4>
            <ul>
                @foreach ($order->items as $item)
                    <li>
                        {{ $item->product->name ?? 'Unknown Product' }}
                        ({{ $item->quantity }} × ${{ number_format($item->price_at_purchase, 2) }})
                    </li>
                @endforeach
            </ul>

           
            @if ($lastOrderShipping && $order->order_id == $lastOrderId)
                <h4>Shipping Info:</h4>
                <p>
                    {{ $lastOrderShipping['address'] }},
                    {{ $lastOrderShipping['city'] }},
                    {{ $lastOrderShipping['state'] }},
                    {{ $lastOrderShipping['zip'] }},
                    {{ $lastOrderShipping['country'] }}
                </p>
            @endif
        </div>

        <hr style="border-top: 1px solid #ccc; margin: 20px 0;">
    @endforeach
@endif
@endsection
