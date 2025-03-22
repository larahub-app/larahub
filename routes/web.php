<?php

use App\Http\Controllers\Auth\AuthenticatedSessionsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\PackageStarterKitsController;
use App\Http\Controllers\UsersController;
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
| User Profile Settings
|-------------------------------------------
*/

Route::view('/settings', 'settings.index')
    ->middleware('auth')
    ->name('settings');

/*
|-------------------------------------------
| Public User Profiles
|-------------------------------------------
*/

Route::get('/users/{user}', [UsersController::class, 'show'])
    ->name('users.show');

/*
|-------------------------------------------
| Package Routes
|-------------------------------------------
*/

Route::get('/packages', [PackagesController::class, 'index'])
    ->name('packages.index');

Route::get('/packages/create', [PackagesController::class, 'create'])
    ->middleware(['auth'])
    ->name('packages.create');

Route::post('/packages', [PackagesController::class, 'store'])
    ->middleware(['auth', 'throttle:10,1'])
    ->name('packages.store');

Route::get('/packages/{user}/{package}', [PackagesController::class, 'show'])
    ->name('packages.show');

Route::get('/packages/{user}/{package}/starter-kits', [PackageStarterKitsController::class, 'index'])
    ->name('packages.show.starter-kits');
