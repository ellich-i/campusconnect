<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventParticipationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('events', EventController::class);
    Route::patch('events/{event}/cancel', [EventController::class, 'cancel'])->name('events.cancel');
    Route::post('events/{event}/join', [EventParticipationController::class, 'join'])->name('events.join');
    Route::delete('events/{event}/leave', [EventParticipationController::class, 'leave'])->name('events.leave');
});

require __DIR__.'/auth.php';

// Only logged-in admins can enter this group
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn () => 'Admin dashboard (placeholder)')->name('dashboard');
});
