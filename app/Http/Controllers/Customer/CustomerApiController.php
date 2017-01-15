<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Repository\Customer\CustomerRepository;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Response;

class CustomerApiController extends Controller
{
    private $repo;
    private $auth;

    public function __construct(CustomerRepository $repo, Auth $auth)
    {
        $this->middleware('auth');

        $this->repo = $repo;
        $this->auth = $auth->guard();
    }

    public function index(): JsonResponse
    {
        return Response::json($this->repo->all());
    }
}
