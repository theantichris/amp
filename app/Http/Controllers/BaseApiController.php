<?php

namespace AMP\Http\Controllers;

use AMP\Team;

class BaseApiController extends Controller
{
    protected function getTeam(): Team
    {
        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        return $team;
    }
}