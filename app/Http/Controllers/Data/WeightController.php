<?php

namespace AMP\Http\Controllers\Data;

use AMP\Enum\Weight;
use AMP\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Response;

class WeightController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): JsonResponse
    {
        $weights = Weight::getConstants();

        return Response::json([
            'weights' => $weights,
        ]);
    }
}
