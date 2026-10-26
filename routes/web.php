<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipationController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EventModerationController;
use App\Http\Controllers\Admin\LocationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);

    Route::patch('events/{event}/cancel', [EventController::class, 'cancel'])
        ->name('events.cancel');

    Route::post('events/{event}/join', [EventParticipationController::class, 'join'])
        ->name('events.join');

    Route::delete('events/{event}/leave', [EventParticipationController::class, 'leave'])
        ->name('events.leave');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class)
            ->except(['show', 'create']);

        Route::resource('locations', LocationController::class)
            ->except(['show', 'create']);

        Route::get('users', [UserController::class, 'index'])
            ->name('users.index');

        Route::patch('users/{user}/role', [UserController::class, 'updateRole'])
            ->name('users.role');

        Route::get('events', [EventModerationController::class, 'index'])
            ->name('events.index');

        Route::patch('events/{event}/cancel', [EventModerationController::class, 'cancel'])
            ->name('events.cancel');

        Route::delete('events/{event}', [EventModerationController::class, 'destroy'])
            ->name('events.destroy');
    });

require __DIR__.'/auth.php';
