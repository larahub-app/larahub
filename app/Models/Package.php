<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submitter_id',
        'name',
        'vendor',
        'display_name',
        'description',
        'repo_url',
        'official',
        'parsed_readme',
        'readme_last_parsed_at',
        'type',
        'installation_method',
        'website',
        'languages',
        'stars_count',
        'last_synced_at',
        'default_branch',
        'meta',
        'processed_at',
    ];

    public function casts()
    {
        return [
            'official' => 'boolean',
            'readme_last_parsed_at' => 'datetime',
            'last_synced_at' => 'datetime',
            'meta' => 'array',
            'processed_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'name';
    }

    public function getRouteKey(): string
    {
        return $this->name;
    }

    public function hasBeenProcessed(): bool
    {
        return $this->processed_at !== null;
    }

    /*
    |-------------------------------------------
    | Scopes
    |-------------------------------------------
    */

    public function scopeProcessed(Builder $query): Builder
    {
        return $query->whereNotNull('processed_at');
    }

    /*
    |-------------------------------------------
    | Relationships
    |-------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitter_id');
    }
}
