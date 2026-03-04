<?php

use App\Models\Setting;

if (! function_exists('app_setting')) {
    function app_setting(string $key, mixed $default = null): mixed
    {
        $setting = Setting::where('key', $key)->value('value');

        return $setting ?? $default;
    }
}

