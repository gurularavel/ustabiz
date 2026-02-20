<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();
        return view('admin.services.edit', compact('service'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Yeni xidmət əlavə edildi.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validated($request, $service->id);
        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Xidmət yeniləndi.');
    }

    public function duplicate(Service $service)
    {
        $new = $service->replicate();
        $new->name       = $service->name . ' (Kopya)';
        $new->slug       = $service->slug . '-kopya-' . Str::random(4);
        $new->is_active  = false;
        $new->sort_order = $service->sort_order + 1;
        $new->save();

        return redirect()->route('admin.services.edit', $new)
                         ->with('success', 'Xidmət dublikat edildi. Redaktə edib aktivləşdirə bilərsiniz.');
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'slug'        => ['required', 'string', 'max:255', 'unique:services,slug,' . ($ignoreId ?? 'NULL')],
            'icon'        => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string'],
            'hero_desc'   => ['nullable', 'string'],
            'price_from'  => ['nullable', 'numeric'],
            'sort_order'  => ['integer'],
            'problems'    => ['nullable', 'string'],
            'brands'      => ['nullable', 'string'],
            'faqs'        => ['nullable', 'string'],
        ]);

        foreach (['problems', 'brands', 'faqs'] as $field) {
            if (!empty($data[$field])) {
                $decoded = json_decode($data[$field], true);
                $data[$field] = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
            } else {
                $data[$field] = null;
            }
        }

        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
