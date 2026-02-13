@extends('layouts.app')

@section('content')
<h1>Checkout</h1>

@if(!$cart || $cart->items->isEmpty())
    <p>Your cart is empty.</p>
@else
<form action="{{ route('checkout.process') }}" method="POST">
    @csrf

    <label>Name</label>
    <input type="text" name="customer_name" required>
 
    <label for="shipping_address">Address</label>
    <input type="text" name="shipping_address" id="shipping_address" required>

    <label for="shipping_city">City</label>
    <input type="text" name="shipping_city" id="shipping_city" required>

    <label for="shipping_state">State</label>
    <input type="text" name="shipping_state" id="shipping_state" required>

    <label for="shipping_zip">ZIP Code</label>
    <input type="text" name="shipping_zip" id="shipping_zip" required>

    <label for="shipping_country">Country</label>
    <input type="text" name="shipping_country" id="shipping_country" required>
    
    <button type="submit">Place Order</button>
</form>
@endif

@endsection
