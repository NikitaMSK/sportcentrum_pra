
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LesController;

Route::get('/', [LesController::class, 'index']);

Route::get('/lessen', function () {
    $lessen = [];
    return view('lessen.lessen', compact('lessen'));
});