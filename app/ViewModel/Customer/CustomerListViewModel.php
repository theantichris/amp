<?php

namespace AMP\ViewModel\Customer;

use AMP\ViewModel\ViewModel;

class CustomerListViewModel extends ViewModel
{
    public $id;
    public $accountNumber;
    public $companyName;
    public $contactName;
    public $contactEmail;

    public function __construct(
        int $id,
        string $accountNumber,
        string $companyName,
        string $contactName,
        string $contactEmail
    ) {
        $this->id = $id;
        $this->accountNumber = $accountNumber;
        $this->companyName = $companyName;
        $this->contactName = $contactName;
        $this->contactEmail = $contactEmail;
    }
}