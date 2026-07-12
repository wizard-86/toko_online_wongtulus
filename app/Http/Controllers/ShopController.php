<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function landing()
    {
        $categories = \App\Models\Category::all();
        $latestProducts = \App\Models\Product::with('category')->latest()->take(8)->get();
        
        return view('shop.landing', compact('categories', 'latestProducts'));
    }

    public function index(Request $request)
    {
        $query = \App\Models\Product::with('category')->latest();

        // Filter pencarian nama
        if ($request->has('q') && $request->q != '') {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = \App\Models\Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show(\App\Models\Product $product)
    {
        $product->load('category');
        return view('shop.show', compact('product'));
    }
}
