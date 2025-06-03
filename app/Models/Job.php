<?php

namespace App\Models;

use Database\Factories\JobFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property \App\Models\Employer|null $employer
 *
 * @method void tag(string $name)
 */
class Job extends Model
{
    /** @use HasFactory<JobFactory> */
    use HasFactory;

    public function tag(string $name): void
    {
        $tag = Tag::firstOrCreate(['name' => $name]);
        $this->tags()->attach($tag);
    }

    /**
     * @return BelongsToMany<\App\Models\Tag, \App\Models\Job, \Illuminate\Database\Eloquent\Relations\Pivot, 'pivot'>
     */
    public function tags(): BelongsToMany
    {
        /** @var BelongsToMany<\App\Models\Tag, \App\Models\Job, \Illuminate\Database\Eloquent\Relations\Pivot, 'pivot'> */
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return BelongsTo<\App\Models\Employer, \App\Models\Job>
     */
    public function employer(): BelongsTo
    {
        /** @var BelongsTo<\App\Models\Employer, \App\Models\Job> */
        return $this->belongsTo(Employer::class);
    }
}