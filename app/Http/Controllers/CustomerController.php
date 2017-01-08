<?php

namespace AMP\Http\Controllers;

use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('customer.index');
    }
}
