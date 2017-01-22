<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Repository\RepositoryInterface;
use Auth;
use Illuminate\Http\JsonResponse;
use Response;

class CustomerApiController extends Controller
{
    private $repo;

    public function __construct(RepositoryInterface $customerRepo)
    {
        $this->middleware('auth');

        $this->repo = $customerRepo;
    }

    public function index(): JsonResponse
    {
        $customers = $this->repo->findBy('team_id', Auth::user()->currentTeam()->id);

        return Response::json($customers);
    }
}
