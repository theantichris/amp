<?php

namespace AMP\Http\Controllers\Project;

use AMP\Http\Controllers\Controller;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('projects.projects.project-management');
    }
}