<?php

namespace AMP\Http\Controllers\Customer;

use AMP\Http\Controllers\Controller;
use AMP\Service\Customer\CustomerServiceInterface;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private $customerService;

    public function __construct(CustomerServiceInterface $customerService)
    {
        $this->middleware('auth');

        $this->customerService = $customerService;
    }

    public function index(): View
    {
        return view('customers.customer-management');
    }
}
