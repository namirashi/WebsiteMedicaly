<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\SystemLog;
use App\Notifications\OrderPlaced;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);

        SystemLog::create([
            'level' => 'info',
            'message' => "Order {$order->order_number} status: {$oldStatus} → {$request->status}",
            'ip_address' => $request->ip(),
            'user_id' => auth()->id(),
        ]);

        try {
            $order->user->notify(new OrderPlaced($order));
        } catch (\Exception $e) {
            //
        }

        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }
}