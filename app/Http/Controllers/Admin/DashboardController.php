<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'orders_new'         => Order::where('status', 'new')->count(),
            'orders_in_progress' => Order::where('status', 'in_progress')->count(),
            'orders_done'        => Order::where('status', 'done')->count(),
            'orders_cancelled'   => Order::where('status', 'cancelled')->count(),
            'orders_total'       => Order::count(),
            'services'           => Service::count(),
            'testimonials'       => Testimonial::count(),
        ];

        $recentOrders = Order::with('service')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }
}
