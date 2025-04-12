<?php

namespace App\Http\Controllers\Packages;

use App\Models\Package;
use App\Models\User;

class PackageArticlesController
{
    public function index(User $user, Package $package)
    {
        $articles = $package->allArticles()->with('submitter')->paginate(10);

        return view('packages.show.articles', [
            'package' => $package,
            'articles' => $articles,
        ]);
    }

    public function create(User $user, Package $package)
    {
        return view('packages.show.articles.create', [
            'package' => $package,
        ]);
    }
}
