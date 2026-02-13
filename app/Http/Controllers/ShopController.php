<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $products = $query->get();

        return view('shop.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Get other products (exclude current one)
        $relatedProducts = Product::where('product_id', '!=', $product->product_id)
                                  ->take(4)
                                  ->get();

        return view('shop.show', compact('product', 'relatedProducts'));
    }
}
