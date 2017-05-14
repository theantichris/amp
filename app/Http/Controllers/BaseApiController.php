<?php

namespace AMP\Http\Controllers;

use AMP\Team;
use Auth;

class BaseApiController extends Controller
{
    protected function getTeam(): Team
    {
        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        return $team;
    }
}