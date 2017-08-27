<?php

namespace Tests\Unit\Http\Controllers\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Http\Controllers\Customer\CustomerApiController;
use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Team;
use AMP\User;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;

class CustomerApiControllerTest extends \TestCase
{
    use MockeryPHPUnitIntegration;

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

    public function test_index()
    {
        $mockTeam = $this->getTeam();

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

    private function getTeam(): MockInterface
    {
        $mockUser = \Mockery::mock(User::class);
        $this->mockAuth->shouldReceive('user')
                       ->once()
                       ->andReturn($mockUser);

        $mockTeam = \Mockery::mock(Team::class);
        $mockUser->shouldReceive('currentTeam')
                 ->once()
                 ->andReturn($mockTeam);

        return $mockTeam;
    }
}
