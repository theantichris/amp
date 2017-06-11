<?php

namespace AMP\Http\Controllers;

use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function show(): View
    {
        return view('welcome');
    }
}
