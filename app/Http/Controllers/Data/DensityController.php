<?php

namespace AMP\Http\Controllers\Data;

use AMP\Enum\Density;
use AMP\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Response;

class DensityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): JsonResponse
    {
        $densities = Density::getConstants();

        return Response::json([
            'densities' => $densities,
        ]);
    }
}
