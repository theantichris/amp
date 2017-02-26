<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('customers.index');
    }
}
