<?php

namespace App\Http\Controllers;

use App\Models\Les;

class LesController extends Controller
{
    public function index()
    {
        $lessen = Les::with('trainer')->get();

        return view('home', compact('lessen'));
    }
}