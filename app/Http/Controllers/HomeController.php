<?php

namespace AMP\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teamSubscribed');
    }

    public function show(): View
    {
        return view('home');
    }
}
