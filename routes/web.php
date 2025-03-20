<?php

use App\Http\Controllers\Auth\AuthenticatedSessionsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------
| Auth Routes
|-------------------------------------------
*/

Route::get('/login', [LoginController::class, 'redirectToProvider'])
    ->middleware('guest')
    ->name('login');

Route::get('/login/callback', [LoginController::class, 'handleProviderCallback'])
    ->middleware('guest')
    ->name('login.callback');

Route::post('/logout', [AuthenticatedSessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|-------------------------------------------
| Homepage
|-------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|-------------------------------------------
| Public User Profiles
|-------------------------------------------
*/

// Route::get('/users/{username}', [UserController::class, 'show'])
//     ->middleware('auth')
//     ->name('user.show');
