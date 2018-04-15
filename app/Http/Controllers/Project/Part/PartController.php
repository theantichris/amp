<?php

namespace AMP\Http\Controllers\Project\Part;

use AMP\Http\Controllers\Controller;
use Illuminate\View\View;

class PartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('projects.parts.part-management');
    }
}