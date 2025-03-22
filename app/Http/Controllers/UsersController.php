<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController
{
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
