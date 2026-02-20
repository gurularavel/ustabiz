<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'nullable|string|max:100',
            'phone'      => 'required|string|max:20',
            'service_id' => 'nullable|exists:services,id',
            'address'    => 'nullable|string|max:255',
            'note'       => 'nullable|string|max:1000',
        ]);

        Order::create($validated);

        return response()->json(['success' => true, 'message' => 'Sifarişiniz qeydə alındı. Tezliklə sizinlə əlaqə saxlanacaq.']);
    }
}
