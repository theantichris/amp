<?php

namespace AMP\Http\Controllers\Project\Material;

use AMP\Http\Controllers\Controller;
use Illuminate\View\View;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('projects.materials.material-management');
    }
}