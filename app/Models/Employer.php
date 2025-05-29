<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Employer extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobs(): HasMany
    {
        return $this->hasMany(Job::class);
    }

    protected static function booted(): void
    {
        static::creating(function ($employer) {
            $employer->slug = Str::slug($employer->name);

            $originalSlug = $employer->slug;
            $count = 1;

            while (static::where('slug', $employer->slug)->exists()) {
                $employer->slug = $originalSlug.'-'.$count++;
            }
        });
    }
}
