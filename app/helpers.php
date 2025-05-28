<?php

use App\Models\Expression;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

if (! function_exists('expression')) {
    function expression(string $key): string
    {
        $locale = App::getLocale();

        return Cache::remember("expression_{$locale}_{$key}", 60, function () use ($key, $locale) {
            return Expression::where('key', $key)
                ->where('locale', $locale)
                ->value('value') ?? __('missing.translation') . " ({$key})";
        });
    }
}