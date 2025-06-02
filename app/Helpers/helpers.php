<?php

use App\Models\Expression;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

if (! function_exists('expression')) {
    /**
     * Returns the translated expression, with replacements.
     *
     * @param string $key
     * @param array<string, string> $replace
     * @param string|null $locale
     * @return string
     */
    function expression(string $key, array $replace = [], ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();

        return Cache::remember("expression_{$locale}_{$key}", 60, function () use ($key, $replace, $locale) {
            $value = Expression::where('key', $key)
                ->where('locale', $locale)
                ->value('value');

            if ($value) {
                return strtr($value, $replace);
            }

            return __($key, $replace, $locale);
        });
    }
}