<?php

namespace AMP\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(): View
    {
        return view('home');
    }
}
