<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Team;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerApiController extends BaseApiController
{
    private $customerService;

    public function __construct(Factory $auth, CustomerServiceInterface $customerService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->customerService = $customerService;
    }

    public function index(): JsonResponse
    {
        $customers = $this->customerService->getListViewModels($this->getTeam()->getQueueableId());

        return new JsonResponse([
            'customers' => $customers,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        /** @noinspection PhpUndefinedMethodInspection */
        $team = $this->auth->user()->currentTeam();

        $customer = $this->customerService->createFromJson($json, $team);

        return new JsonResponse([], Response::HTTP_CREATED, [
            'Location' => '/customers/' . $customer->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->customerService->updateFromJson($json, $id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->customerService->getCustomer($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'customer' => $customer,
        ]);
    }
}
