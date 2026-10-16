<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LesController;
use App\Http\Controllers\TrainerPanelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LesController::class, 'index'])->name('home');

Route::get('/lessen', function () {
    $lessen = [];

    return view('lessen.lessen', compact('lessen'));
});

Route::middleware('guest')->group(function (): void {
    Route::get('/inloggen', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/inloggen', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');

    Route::get('/account-aanmaken', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/account-aanmaken', [RegisteredUserController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('register.store');
});

Route::post('/uitloggen', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/trainer/lessen', [TrainerPanelController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/lessen/{les}/members', [TrainerPanelController::class, 'showMembers'])
        ->name('trainer.members');
});
