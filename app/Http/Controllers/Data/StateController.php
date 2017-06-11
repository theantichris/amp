<?php

namespace AMP\Http\Controllers\Data;

use AMP\Enum\StateAbbreviation;
use AMP\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Response;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): JsonResponse
    {
        $states = StateAbbreviation::getConstants();

        return Response::json([
            'states' => $states,
        ]);
    }
}
