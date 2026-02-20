<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.edit', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Rəy əlavə edildi.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $this->validated($request);
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Rəy yeniləndi.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Rəy silindi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'avatar_initial' => ['required', 'string', 'max:5'],
            'text'           => ['required', 'string'],
            'stars'          => ['required', 'integer', 'min:1', 'max:5'],
            'date'           => ['required', 'string', 'max:100'],
            'sort_order'     => ['integer'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
