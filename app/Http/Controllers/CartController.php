<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
   public function index()
{
    $cart = Cart::first(); 
    $items = $cart ? $cart->items : collect([]);
    return view('cart.index', compact('cart','items'));
}

    public function add(Request $request, $productId)
    {
        $cart = Cart::firstOrCreate([]);
        $product = Product::findOrFail($productId);

        $item = CartItem::firstOrCreate(
            ['cart_id' => $cart->cart_id, 'product_id' => $productId],
            ['quantity' => 1, 'price' => $product->price]
        );

        return redirect()->route('cart.index');
    }

    public function update(Request $request, $itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->quantity = $request->quantity;
        $item->price = $item->quantity * $item->product->price;
        $item->save();
        return redirect()->route('cart.index');
    }

    public function remove($itemId)
    {
        CartItem::destroy($itemId);
        return redirect()->route('cart.index');
    }

    

}
