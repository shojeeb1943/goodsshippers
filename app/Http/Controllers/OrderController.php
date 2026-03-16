<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(\App\Http\Requests\StoreOrderRequest $request, \App\Services\OrderService $orderService)
    {
        $order = $orderService->create($request->validated(), auth()->user());
        return redirect()->route('orders.show', $order)->with('success', 'Order submitted successfully.');
    }

    public function show(\App\Models\Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        $order->load('items', 'statusLogs.actor');
        return view('orders.show', compact('order'));
    }

    public function approve(\App\Models\Order $order, \App\Actions\ApproveQuote $approveQuote)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        
        try {
            $approveQuote->execute($order);
            return back()->with('success', 'Quote approved. We will proceed with your order.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(\App\Models\Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);

        if ($order->status !== 'quote_sent') {
            return back()->with('error', 'Only pending quotes can be rejected.');
        }

        $order->update(['status' => 'cancelled']);
        return back()->with('success', 'Order cancelled.');
    }
}
