<?php

namespace AMP\Http\Controllers;

use AMP\Team;
use Illuminate\Contracts\Auth\Factory as Auth;

class BaseApiController extends Controller
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    protected function getTeam(): Team
    {
        /** @var Team $team */
        $team = $this->auth->user()->currentTeam();

        return $team;
    }
}