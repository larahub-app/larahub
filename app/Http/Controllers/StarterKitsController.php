<?php

namespace App\Http\Controllers;

use App\Models\StarterKit;
use App\Models\User;

class StarterKitsController
{
    public function index()
    {
        $kits = StarterKit::latest()->processed()->paginate(5);

        $kits->load(['user', 'submitter']);

        return view('kits.index', [
            'kits' => $kits,
        ]);
    }

    public function show(User $user, StarterKit $kit)
    {
        return view('kits.show.index', [
            'kit' => $kit->load(['user', 'submitter']),
        ]);
    }

    public function create()
    {
        return view('kits.create');
    }
}
