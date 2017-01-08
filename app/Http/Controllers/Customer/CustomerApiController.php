<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Repository\CustomerRepository;
use Illuminate\Http\JsonResponse;
use Response;

class CustomerApiController extends Controller
{
    private $repo;

    public function __construct(CustomerRepository $repo)
    {
        $this->middleware('auth');

        $this->repo = $repo;
    }

    public function index(): JsonResponse
    {
        return Response::json($this->repo->all());
    }
}
