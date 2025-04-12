<?php

namespace App\Models\Concerns;

use App\Models\Article;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasArticles
{
    public function articles(): MorphMany
    {
        return $this->allArticles()->approved();
    }

    public function allArticles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articleable');
    }

    public function pendingArticles(): MorphMany
    {
        return $this->allArticles()->pending();
    }
}
