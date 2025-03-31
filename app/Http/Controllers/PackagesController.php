<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;

class PackagesController
{
    public function index()
    {
        return view('packages.index');
    }

    public function show(User $user, Package $package)
    {
        if (! $package->hasBeenProcessed()) {
            return redirect()->route('packages.index');
        }

        return view('packages.show.index', [
            'package' => $package->load(['user', 'submitter']),
        ]);
    }

    public function create()
    {
        return view('packages.create');
    }
}
