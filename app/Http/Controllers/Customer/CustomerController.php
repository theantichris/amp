<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Service\Customer\CustomerServiceInterface;
use Illuminate\Contracts\View\Factory as Templating;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private $customerService;
    private $templating;

    public function __construct(Templating $view, CustomerServiceInterface $customerService)
    {
        $this->middleware('auth');

        $this->customerService = $customerService;
        $this->templating      = $view;
    }

    public function index(): View
    {
        return $this->templating->make('customers.customer-management');
    }
}
