<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('sort_order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.edit', ['faq' => new Faq()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ əlavə edildi.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $this->validated($request);
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ yeniləndi.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', 'FAQ silindi.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'question'   => ['required', 'string'],
            'answer'     => ['required', 'string'],
            'sort_order' => ['integer'],
        ]);
        $data['is_active'] = $request->boolean('is_active');
        return $data;
    }
}
