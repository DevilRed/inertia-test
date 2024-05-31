<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Todo;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'todos' => Todo::latest()->get(),
        ]);
    }
}
