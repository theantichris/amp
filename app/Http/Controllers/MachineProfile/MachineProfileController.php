<?php

namespace AMP\Http\Controllers\MachineProfile;

use AMP\Http\Controllers\Controller;
use Illuminate\View\View;

class MachineProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('machine-profiles.machine-profile-management');
    }
}