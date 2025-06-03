<?php

namespace App\Models;

use Database\Factories\TagFactory; // se existir, importe a factory
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    /**
     * @return BelongsToMany<\App\Models\Job, \App\Models\Tag, \Illuminate\Database\Eloquent\Relations\Pivot, 'pivot'>
     */
    public function jobs(): BelongsToMany
    {
        /** @var BelongsToMany<\App\Models\Job, \App\Models\Tag, \Illuminate\Database\Eloquent\Relations\Pivot, 'pivot'> */
        return $this->belongsToMany(Job::class);
    }
}