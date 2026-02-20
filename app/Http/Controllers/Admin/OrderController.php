<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $orders   = $query->paginate(20)->withQueryString();
        $services = Service::orderBy('sort_order')->get();

        return view('admin.orders.index', compact('orders', 'services'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:new,in_progress,done,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status yeniləndi.');
    }
}
