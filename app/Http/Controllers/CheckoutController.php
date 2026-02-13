<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;


class CheckoutController extends Controller
{
    public function checkoutForm()
    {
        // Fetch the first cart (or use user-specific cart if needed)
        $cart = Cart::first(); // Replace with user-specific query if necessary

        return view('checkout.index', compact('cart')); // Pass $cart to view
    }

    public function process(Request $request)
    {
        $cart = Cart::first();
        if(!$cart || $cart->items->isEmpty()) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'cart_id' => $cart->cart_id,
            'user_id' => 1, // Replace with auth()->id() if using authentication
            'customer_name' => $request->customer_name,
            'total_amount' => $cart->items->sum(fn($i) => $i->price)
        ]);

        foreach($cart->items as $item){
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price_at_purchase' => $item->price
            ]);
        }
        
        session([
            'last_order_shipping' => [
                'address' => $request->shipping_address,
                'city'    => $request->shipping_city,
                'state'   => $request->shipping_state,
                'zip'     => $request->shipping_zip,
                'country' => $request->shipping_country,
            ],
            'last_order_id' => $order->order_id
        ]);

        $cart->items()->delete(); 

        return redirect()->route('shop.index')->with('success','Order placed!');
    }
}
