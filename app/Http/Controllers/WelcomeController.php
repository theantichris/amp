<?php

namespace AMP\Http\Controllers;

use Response;

class WelcomeController extends Controller
{
    public function show(): Response
    {
        return view('welcome');
    }
}
