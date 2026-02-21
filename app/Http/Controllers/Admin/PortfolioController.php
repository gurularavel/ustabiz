<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $items = Portfolio::with('service')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate(15);
        return view('admin.portfolio.index', compact('items'));
    }

    public function create()
    {
        $item     = new Portfolio();
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.portfolio.edit', compact('item', 'services'));
    }

    public function store(Request $request)
    {
        Portfolio::create($this->validated($request));
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio elementi əlavə edildi.');
    }

    public function edit(Portfolio $portfolio)
    {
        $services = Service::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.portfolio.edit', compact('portfolio', 'services'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $portfolio->update($this->validated($request));
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio elementi yeniləndi.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio elementi silindi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'youtube_url' => ['nullable', 'string', 'max:500'],
            'service_id'  => ['nullable', 'exists:services,id'],
            'sort_order'  => ['integer'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
