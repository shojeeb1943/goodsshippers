<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->has('category') && $request->category) {
            $query->where('category', $request->category);
        }

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $products = $query->orderBy('name')->paginate(12);
        $categories = Product::where('is_active', true)->distinct()->pluck('category')->filter()->values();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (! $product->is_active) {
            abort(404);
        }

        $related = Product::where('id', '!=', $product->id)
            ->where('category', $product->category)
            ->where('is_active', true)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
