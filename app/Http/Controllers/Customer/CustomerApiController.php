<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Team;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class CustomerApiController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->middleware('auth');

        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getListViewModels(Auth::user()->currentTeam()->getQueueableId());

        return Response::json([
            'customers' => $customers,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        $customer = $this->customerService->saveFromJson($json, $team);

        return Response::json([], 201, [
            'Location' => '/customers/' . $customer->getId(),
        ]);
    }
}
