<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'avatar',
        'bio',
        'website',
        'status',
        'auth_provider',
        'auth_token',
        'auth_type',
        'laravel_employee',
        'unclaimed',
        'claimed_at',
        'meta',
        'twitter',
        'bluesky',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'auth_token',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'claimed_at' => 'datetime',
            'meta' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'username';
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getWebsiteAttribute(): ?string
    {
        $value = $this->attributes['website'];

        if ($value === null || $value === '') {
            return null;
        }

        if (str($value)->startsWith(['http://'])) {
            $value = str($value)->replace('http://', 'https://');
        } elseif (str($value)->startsWith(['//'])) {
            $value = str($value)->replace('//', 'https://');
        } else {
            $value = 'https://'.$value;
        }

        return (string) $value;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'user_id');
    }
}
