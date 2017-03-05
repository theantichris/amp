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
        return view('customers.index');
    }

    public function create(): View
    {
        return view('customers.form')->with('customerId', null);
    }

    public function show(int $id): View
    {
        $customer = $this->customerService->getCustomer($id);

        return view('customers.detail')->with('customer', $customer);
    }
}
