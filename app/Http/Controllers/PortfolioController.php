<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __invoke(Request $request)
    {
        $serviceId = $request->query('service');

        $query = Portfolio::with('service')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderByDesc('id');

        if ($serviceId) {
            $query->where('service_id', $serviceId);
        }

        $items    = $query->paginate(12)->withQueryString();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('portfolio.index', compact('items', 'services', 'serviceId'));
    }
}
