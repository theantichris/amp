<?php

namespace Tests\Unit\Http\Controllers\Customer;

use AMP\Http\Controllers\Customer\CustomerController;
use AMP\Service\Customer\CustomerServiceInterface;
use Illuminate\Contracts\View\Factory as Templating;
use Illuminate\View\View;
use Mockery\MockInterface;

class CustomerControllerTest extends \TestCase
{
    /** @var  MockInterface */
    private $mockTemplating;

    /** @var  MockInterface */
    private $mockCustomerService;

    /** @var CustomerController * */
    private $uut;

    public function setUp()
    {
        $this->mockTemplating      = \Mockery::mock(Templating::class);
        $this->mockCustomerService = \Mockery::mock(CustomerServiceInterface::class);

        $this->uut = new CustomerController(
            $this->mockTemplating,
            $this->mockCustomerService
        );
    }

    /** @test */
    public function returns_the_customer_index_view()
    {
        $mockView = \Mockery::mock(View::class);

        $this->mockTemplating->shouldReceive('make')
                             ->once()
                             ->with('customers.customer-management')
                             ->andReturn($mockView);

        $actual = $this->uut->index();

        $this->assertEquals($mockView, $actual);
    }
}
