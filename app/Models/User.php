<?php

namespace App\Models;

use App\Notifications\CustomResetPasswordNotification;
use Database\Factories\UserFactory; // importe se existir
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Employer $employer
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * @return HasOne<\App\Models\Employer, self>
     */
    public function employer(): HasOne
    {
        /** @var HasOne<\App\Models\Employer, self> */
        return $this->hasOne(Employer::class);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}