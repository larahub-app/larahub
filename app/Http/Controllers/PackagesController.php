<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;

class PackagesController
{
    public function index()
    {
        $packages = Package::latest()->processed()->paginate(5);

        $packages->load(['user', 'submitter']);

        return view('packages.index', [
            'packages' => $packages,
        ]);
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
