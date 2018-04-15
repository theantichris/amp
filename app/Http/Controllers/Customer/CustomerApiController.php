<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Customer\CustomerResource;
use AMP\Service\Customer\CustomerServiceInterface;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
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

    public function index(): ResourceCollection
    {
        $customers = Customer::whereTeamId($this->getTeam()->getQueueableId())->get();

        return CustomerResource::collection($customers);
    }

    public function create(Request $request): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $customer = $this->customerService->createFromJson(
            $request->getContent(),
            $this->auth->user()->currentTeam()
        );

        return new JsonResponse([], Response::HTTP_CREATED, [
            'Location' => '/customers/' . $customer->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->customerService->updateFromJson($request->getContent(), $id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): CustomerResource
    {
        $customer = Customer::find($id);

        return new CustomerResource($customer);
    }
}
