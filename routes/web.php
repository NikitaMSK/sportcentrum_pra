<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LesController;

Route::get('/', [LesController::class, 'index']);