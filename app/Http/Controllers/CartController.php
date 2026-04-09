<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|string',
        ]);

        $cart = session('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'image' => $request->image ?? null,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity')),
            'message' => 'Product added to cart',
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session('cart', []);
        $productId = $request->product_id;

        if ($request->quantity === 0) {
            unset($cart[$productId]);
        } elseif (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
        }

        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $cart = session('cart', []);
        unset($cart[$request->product_id]);
        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

    public function clear()
    {
        session()->forget('cart');

        return response()->json(['success' => true]);
    }

    public function count()
    {
        $cart = session('cart', []);

        return response()->json(['count' => array_sum(array_column($cart, 'quantity'))]);
    }
}
