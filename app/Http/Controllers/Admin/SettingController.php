<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'phone'          => ['nullable', 'string', 'max:255'],
            'address'        => ['nullable', 'string', 'max:255'],
            'email'          => ['nullable', 'email', 'max:255'],
            'working_hours'  => ['nullable', 'string', 'max:255'],
            'facebook_url'   => ['nullable', 'url', 'max:255'],
            'instagram_url'  => ['nullable', 'url', 'max:255'],
            'whatsapp_url'   => ['nullable', 'url', 'max:255'],
            'youtube_url'    => ['nullable', 'url', 'max:255'],
            'map_url'        => ['nullable', 'string', 'max:1000'],
        ]);

        foreach ($request->except(['_token', '_method']) as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Tənzimləmələr saxlanıldı.');
    }
}
