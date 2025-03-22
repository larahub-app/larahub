<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\User;

class PackageStarterKitsController
{
    public function index(User $user, Package $package)
    {
        return view('packages.show.starter-kits', [
            'package' => $package,
        ]);
    }
}
