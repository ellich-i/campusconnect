<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Student dashboard: events I created and events I joined
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Breeze profile pages
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Event features (any logged-in user; ownership is checked by EventPolicy)
Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
    Route::patch('events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');
    Route::post('events/{event}/join', [EventParticipationController::class, 'join'])->name('events.join');
    Route::delete('events/{event}/leave', [EventParticipationController::class, 'leave'])->name('events.leave');
});

// Admin area: must be logged in AND have the admin role
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', Admin\CategoryController::class)
        ->except(['show', 'create']);

    Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role', [Admin\UserController::class, 'updateRole'])->name('users.role');

    Route::get('events', [Admin\EventModerationController::class, 'index'])->name('events.index');
    Route::patch('events/{event}/cancel', [Admin\EventModerationController::class, 'cancel'])->name('events.cancel');
    Route::delete('events/{event}', [Admin\EventModerationController::class, 'destroy'])->name('events.destroy');
});

require __DIR__.'/auth.php';