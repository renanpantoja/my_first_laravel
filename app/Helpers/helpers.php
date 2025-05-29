<?php

namespace App\Helpers;

use App\Models\Expression;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

if (! function_exists('expression')) {
    function expression(string $key, array $replace = [], ?string $locale = null): string
    {
        $locale = $locale ?? App::getLocale();

        return Cache::remember("expression_{$locale}_{$key}", 60, function () use ($key, $replace, $locale) {
            // 1. Tenta buscar no banco
            $value = Expression::where('key', $key)
                ->where('locale', $locale)
                ->value('value');

            if ($value) {
                return strtr($value, $replace); // substitui valores tipo ":name"
            }

            // 2. Se não tiver no banco, usa arquivo padrão do Laravel
            return __($key, $replace, $locale);
        });
    }
}
