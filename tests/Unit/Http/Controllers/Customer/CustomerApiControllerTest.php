<?php

namespace Tests\Unit\Http\Controllers\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Http\Controllers\Customer\CustomerApiController;
use AMP\Service\Customer\CustomerServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery\MockInterface;

class CustomerApiControllerTest extends \TestCase
{
    /** @var  MockInterface */
    private $mockAuth;

    /** @var  MockInterface */
    private $mockCustomerService;

    /** @var CustomerApiController * */
    private $uut;

    public function setUp()
    {
        $this->mockAuth            = \Mockery::mock(Auth::class);
        $this->mockCustomerService = \Mockery::mock(CustomerServiceInterface::class);

        $this->uut = new CustomerApiController($this->mockAuth, $this->mockCustomerService);
    }

    /** @test */
    public function returns_a_json_response_with_customer_view_models()
    {
        $mockTeam = $this->getTeam($this->mockAuth);

        $teamId = 1;
        $mockTeam->shouldReceive('getQueueableId')
                 ->once()
                 ->andReturn($teamId);

        $mockCustomer = \Mockery::mock(Customer::class);
        $this->mockCustomerService->shouldReceive('getListViewModels')
                                  ->once()
                                  ->with($teamId)
                                  ->andReturn([$mockCustomer]);

        $mockCustomer->shouldReceive('jsonSerialize')
                     ->once()
                     ->andReturn('{"property":"value"}');

        $expected = new JsonResponse([
            'customers' => ['{"property":"value"}'],
        ]);

        $actual = $this->uut->index();

        $this->assertEquals($expected->getContent(), $actual->getContent());
    }

    /** @test */
    public function creates_a_customer_and_returns_a_json_response()
    {
        $mockRequest = \Mockery::mock(Request::class);

        $json = '{"property":"value"}';
        $mockRequest->shouldReceive('getContent')
                    ->once()
                    ->andReturn($json);

        $mockTeam = $this->getTeam($this->mockAuth);

        $mockCustomer = \Mockery::mock(Customer::class);
        $this->mockCustomerService->shouldReceive('createFromJson')
                                  ->once()
                                  ->with($json, $mockTeam)
                                  ->andReturn($mockCustomer);

        $customerId = 1;
        $mockCustomer->shouldReceive('getId')
                     ->once()
                     ->andReturn($customerId);

        $expected = new JsonResponse([], Response::HTTP_CREATED, [
            'Location' => '/customers/' . $customerId,
        ]);
        $actual   = $this->uut->create($mockRequest);

        $this->assertEquals($expected->getContent(), $actual->getContent());
        $this->assertEquals($expected->getStatusCode(), $actual->getStatusCode());
        $this->assertEquals($expected->headers->get('Location'), $actual->headers->get('Location'));
    }

    /** @test */
    public function updates_a_customer_and_returns_a_json_response()
    {
        $id          = 1;
        $mockRequest = \Mockery::mock(Request::class);

        $json = '{"property":"value"}';
        $mockRequest->shouldReceive('getContent')
                    ->once()
                    ->andReturn($json);

        $this->mockCustomerService->shouldReceive('updateFromJson')
                                  ->once()
                                  ->with($json, $id);

        $expected = new JsonResponse([], Response::HTTP_NO_CONTENT);
        $actual   = $this->uut->update($id, $mockRequest);

        $this->assertEquals($expected->getContent(), $actual->getContent());
        $this->assertEquals($expected->getStatusCode(), $actual->getStatusCode());
    }

    /** @test */
    public function serializes_a_customer_and_returns_a_json_response()
    {
        $customerId = 1;

        $mockTeam = $this->getTeam($this->mockAuth);

        $teamId = 2;
        $mockTeam->shouldReceive('getQueueableId')
                 ->once()
                 ->andReturn($teamId);

        $mockCustomer = \Mockery::mock(Customer::class);
        $this->mockCustomerService->shouldReceive('getCustomer')
                                  ->once()
                                  ->with($customerId, $teamId)
                                  ->andReturn($mockCustomer);

        $model = ['model'];
        $mockCustomer->shouldReceive('jsonSerialize')
                     ->once()
                     ->andReturn($model);

        $expected = new JsonResponse(['customer' => $model]);
        $actual   = $this->uut->show($customerId);

        $this->assertEquals($expected->getContent(), $actual->getContent());
    }
}
