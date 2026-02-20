<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // ── HERO ──────────────────────────────────────────────────────────────────

    public function heroEdit()
    {
        $s = Setting::pluck('value', 'key');
        return view('admin.pages.hero', compact('s'));
    }

    public function heroUpdate(Request $request)
    {
        $keys = [
            'hero_label', 'hero_title', 'hero_title_span', 'hero_desc',
            'hero_stat1_value', 'hero_stat1_label',
            'hero_stat2_value', 'hero_stat2_label',
            'hero_stat3_value', 'hero_stat3_label',
            'hero_trust_count',
            'hero_form_title', 'hero_form_subtitle',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return back()->with('success', 'Hero bölməsi yeniləndi.');
    }

    // ── ABOUT ─────────────────────────────────────────────────────────────────

    public function aboutEdit()
    {
        $s = Setting::pluck('value', 'key');
        return view('admin.pages.about', compact('s'));
    }

    public function aboutUpdate(Request $request)
    {
        $keys = [
            'about_hero_title', 'about_hero_desc',
            'about_story_label', 'about_story_title', 'about_story_content',
            'about_value1_icon', 'about_value1_title', 'about_value1_text',
            'about_value2_icon', 'about_value2_title', 'about_value2_text',
            'about_value3_icon', 'about_value3_title', 'about_value3_text',
            'about_stat1_value', 'about_stat1_label',
            'about_stat2_value', 'about_stat2_label',
            'about_stat3_value', 'about_stat3_label',
            'about_stat4_value', 'about_stat4_label',
            'about_team_title', 'about_team_desc',
            'about_team1_emoji', 'about_team1_name', 'about_team1_role', 'about_team1_exp',
            'about_team2_emoji', 'about_team2_name', 'about_team2_role', 'about_team2_exp',
            'about_team3_emoji', 'about_team3_name', 'about_team3_role', 'about_team3_exp',
            'about_team4_emoji', 'about_team4_name', 'about_team4_role', 'about_team4_exp',
            'about_cta_title', 'about_cta_desc',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return back()->with('success', '"Haqqımızda" səhifəsi yeniləndi.');
    }
}
