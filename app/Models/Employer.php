<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property \App\Models\User $user
 * @property int $user_id
 */
class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    /**
     * @return BelongsTo<\App\Models\User, \App\Models\Employer>
     */
    public function user(): BelongsTo
    {
        /** @var BelongsTo<\App\Models\User, \App\Models\Employer> */
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<\App\Models\Job, \App\Models\Employer>
     */
    public function jobs(): HasMany
    {
        /** @var HasMany<\App\Models\Job, \App\Models\Employer> */
        return $this->hasMany(Job::class);
    }

    protected static function booted(): void
    {
        static::creating(function (self $employer) {
            $employer->slug = Str::slug($employer->name);

            $originalSlug = $employer->slug;
            $count = 1;

            while (static::where('slug', $employer->slug)->exists()) {
                $employer->slug = $originalSlug . '-' . $count++;
            }
        });
    }
}