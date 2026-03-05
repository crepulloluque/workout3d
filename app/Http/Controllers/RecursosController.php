<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecursosController extends Controller
{
    public function index()
    {
        // ✅ SIN protección de sesión
        return view('recursos');
    }
}