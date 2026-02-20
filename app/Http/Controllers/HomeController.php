<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Models\Faq;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $services     = Service::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $advantages   = Advantage::where('is_active', true)->orderBy('sort_order')->get();
        $faqs         = Faq::where('is_active', true)->orderBy('sort_order')->get();
        $partners     = Partner::where('is_active', true)->orderBy('sort_order')->pluck('name');

        return view('home.index', compact('services', 'testimonials', 'advantages', 'faqs', 'partners'));
    }
}
