<?php

namespace AMP\ViewModel\Project;

use AMP\ViewModel\ViewModel;

class ProjectListViewModel extends ViewModel
{
    public $id;
    public $name;
    public $manager;
    public $status;
    public $customer;

    public function __construct(
        int $id,
        string $name,
        ?string $manager,
        string $status,
        string $customer
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->manager  = $manager;
        $this->status   = $status;
        $this->customer = $customer;
    }
}