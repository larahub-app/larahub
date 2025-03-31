<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as SocialiateUser;

class LoginController
{
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallback()
    {
        $developer = Socialite::driver('github')->user();

        $user = User::where('username', $developer->getNickname())->first();

        if ($user === null) {
            $user = $this->registerNewUser($developer);
        } elseif ($user->unclaimed) {
            $user = $this->claimUserAccount($user, $developer);
        } else {
            $user = $this->updateUser($user, $developer);
        }

        Auth::login($user);

        return redirect()->intended(default: route('home'));
    }

    protected function registerNewUser(SocialiateUser $user)
    {
        $user = User::create([
            'username' => Str::slug($user->getNickname()),
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'bio' => $user->user['bio'],
            'website' => $user->user['blog'],
            'auth_provider' => 'github',
            'auth_token' => $user->token,
            'auth_type' => 'user',
            'laravel_employee' => false,
            'unclaimed' => false,
            'claimed_at' => now(),
            'meta' => json_encode($user->user),
        ]);

        return $user;
    }

    public function claimUserAccount(User $user, SocialiateUser $developer)
    {
        $user->update([
            'name' => $developer->name,
            'email' => $developer->email,
            'avatar' => $developer->avatar,
            'bio' => $developer->user['bio'],
            'website' => $developer->user['blog'],
            'auth_token' => $developer->token,
            'unclaimed' => false,
            'claimed_at' => now(),
            'meta' => json_encode($developer->user),
        ]);

        return $user;
    }

    protected function updateUser(User $user, SocialiateUser $developer)
    {
        $user->update([
            'name' => $developer->name,
            'email' => $developer->email, // shoud we update this on every login?
            'avatar' => $developer->avatar,
            'bio' => $developer->user['bio'],
            'website' => $developer->user['blog'],
            'auth_token' => $developer->token,
            'meta' => json_encode($developer->user),
        ]);

        return $user;
    }
}
