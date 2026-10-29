<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LesController;
use App\Http\Controllers\TrainerPanelController;
use Illuminate\Support\Facades\Route;

Route::middleware('not.trainer')->group(function (): void {
    // Homepage
    Route::get('/', [LesController::class, 'index'])->name('home');

    // Lessenpagina
    Route::get('/lessen', function () {
        $lessen = [];

        return view('lessen.lessen', compact('lessen'));
    })->name('lessen');

    // Mijn reserveringen
    Route::get('/reserveringen', [LesController::class, 'reserveringen'])
        ->middleware('auth')
        ->name('reserveringen');

    // Aanmelden voor een les
    Route::post('/lessen/{les}/aanmelden', [LesController::class, 'aanmelden'])
        ->middleware('auth')
        ->name('lessen.aanmelden');

    // Reservering annuleren
    Route::delete('/reserveringen/{aanmelding}', [LesController::class, 'annuleren'])
        ->middleware('auth')
        ->name('reserveringen.annuleren');
});

// Inloggen en registreren
Route::middleware('guest')->group(function (): void {
    Route::get('/inloggen', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/inloggen', [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:login')
        ->name('login.store');

    Route::get('/account-aanmaken', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/account-aanmaken', [RegisteredUserController::class, 'store'])
        ->middleware('throttle:5,1')
        ->name('register.store');
});

// Uitloggen
Route::post('/uitloggen', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/trainer/lessen', [TrainerPanelController::class, 'index'])->name('trainer.index');
    Route::get('/trainer/lessen/{les}/members', [TrainerPanelController::class, 'showMembers'])
        ->name('trainer.members');
});
