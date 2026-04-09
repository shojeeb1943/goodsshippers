<?php

namespace App\Http\Controllers;

use App\Actions\ApproveQuote;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->orders();

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $query->where('id', 'like', '%'.$request->search.'%');
        }

        $orders = $query->latest()->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
    }

    public function store(StoreOrderRequest $request, OrderService $orderService)
    {
        $order = $orderService->create($request->validated(), auth()->user());

        return redirect()->route('orders.show', $order)->with('success', 'Order submitted successfully.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        $order->load('items', 'statusLogs.actor');

        return view('orders.show', compact('order'));
    }

    public function approve(Order $order, ApproveQuote $approveQuote)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        try {
            $approveQuote->execute($order);

            return back()->with('success', 'Quote approved. We will proceed with your order.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function reject(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'quote_sent') {
            return back()->with('error', 'Only pending quotes can be rejected.');
        }

        $order->update(['status' => 'cancelled']);

        return back()->with('success', 'Order cancelled.');
    }
}
