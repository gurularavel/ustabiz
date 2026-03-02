<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TextController extends Controller
{
    public function index()
    {
        $sections = config('editable_texts.sections', []);
        $settings = Setting::pluck('value', 'key');

        return view('admin.texts.index', compact('sections', 'settings'));
    }

    public function update(Request $request)
    {
        $sections = config('editable_texts.sections', []);
        $fields = collect($sections)->flatten(1);

        $rules = [];
        foreach ($fields as $field) {
            $rules[$field['key']] = ['nullable', 'string', 'max:10000'];
        }

        $validated = $request->validate($rules);

        foreach ($fields as $field) {
            $key = $field['key'];
            Setting::set($key, (string) ($validated[$key] ?? ''));
        }

        return back()->with('success', 'Mətnlər uğurla yeniləndi.');
    }
}

