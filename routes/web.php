<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LesController;

<<<<<<< Updated upstream
Route::get('/', [LesController::class, 'index']);
=======
Route::get('/', function () {
    return view('welcome');
});

Route::get('/lessen', function () {
    return view('lessen');
});
>>>>>>> Stashed changes
