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

    // ── HOME (other sections) ─────────────────────────────────────────────────

    public function homeEdit()
    {
        $s = Setting::pluck('value', 'key');
        return view('admin.pages.home', compact('s'));
    }

    public function homeUpdate(Request $request)
    {
        $keys = [
            'services_label', 'services_title', 'services_desc',
            'cta_title', 'cta_title_span', 'cta_desc',
            'adv_label', 'adv_title', 'adv_desc',
            'steps_label', 'steps_title', 'steps_desc',
            'step1_icon', 'step1_title', 'step1_desc',
            'step2_icon', 'step2_title', 'step2_desc',
            'step3_icon', 'step3_title', 'step3_desc',
            'step4_icon', 'step4_title', 'step4_desc',
            'reviews_label', 'reviews_title', 'reviews_desc',
            'reviews_stat1_value', 'reviews_stat1_label',
            'reviews_stat2_value', 'reviews_stat2_label',
            'reviews_stat3_value', 'reviews_stat3_label',
            'reviews_stat4_value', 'reviews_stat4_label',
            'partners_label', 'partners_title', 'partners_desc',
            'faq_label', 'faq_title', 'faq_desc',
            'home_contact_label', 'home_contact_title', 'home_contact_desc',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return back()->with('success', 'Ana səhifə məzmunu yeniləndi.');
    }

    // ── CONTACT PAGE ──────────────────────────────────────────────────────────

    public function contactEdit()
    {
        $s = Setting::pluck('value', 'key');
        return view('admin.pages.contact', compact('s'));
    }

    public function contactUpdate(Request $request)
    {
        $keys = [
            'contact_hero_title', 'contact_hero_desc',
            'contact_h2', 'contact_intro',
            'contact_form_title', 'contact_form_desc',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key));
        }

        return back()->with('success', '"Əlaqə" səhifəsi yeniləndi.');
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
