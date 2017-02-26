<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Service\Customer\CustomerService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class CustomerApiController extends Controller
{
    private $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->middleware('auth');

        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getListViewModels(Auth::user()->currentTeam()->id);

        return Response::json($customers);
    }

    public function save(Request $request): JsonResponse
    {
        dd($request);
    }
}
