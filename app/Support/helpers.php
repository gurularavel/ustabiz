<?php

use App\Models\Setting;

if (!function_exists('site_text')) {
    function site_text(string $key, string $default = ''): string
    {
        return Setting::get($key, $default);
    }
}

