<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request)
    {
        $s       = Setting::pluck('value', 'key');
        $members = TeamMember::where('is_active', true)->orderBy('sort_order')->get();

        return view('pages.about', compact('s', 'members'));
    }
}
