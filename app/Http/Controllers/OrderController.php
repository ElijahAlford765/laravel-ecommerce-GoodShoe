<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = Cart::with('items.product')->first(); 
        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:255',
        ]);

        $cart = Cart::with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                             ->with('error', 'Cart is empty.');
        }

        
        $order = Order::create([
            'cart_id'       => $cart->cart_id,
            'user_id'       => 1,
            'customer_name' => $request->customer_name,
            'total_amount'  => $cart->total,
        ]);

        
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id'         => $order->order_id,
                'product_id'       => $item->product_id,
                'quantity'         => $item->quantity,
                'price_at_purchase'=> $item->price,
            ]);
        }

        
        session(['last_order_shipping' => [
            'address' => $request->shipping_address,
            'city'    => $request->shipping_city,
            'state'   => $request->shipping_state,
            'zip'     => $request->shipping_zip,
            'country' => $request->shipping_country,
        ]]);

       
        $cart->items()->delete();
        $cart->update(['total' => 0]);

        return redirect()->route('orders.index')
                         ->with('success', 'Order placed successfully!');
    }

    public function index()
{
    $orders = Order::with('items.product')->get();
    $lastOrderShipping = session('last_order_shipping', null);
    $lastOrderId = session('last_order_id', null);

    return view('orders.index', compact('orders', 'lastOrderShipping', 'lastOrderId'));
}
}
