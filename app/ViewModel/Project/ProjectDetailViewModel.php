<?php

namespace AMP\ViewModel\Project;

use AMP\ViewModel\ViewModel;

class ProjectDetailViewModel extends ViewModel
{
    public $id;
    public $name;
    public $manager;
    public $status;
    public $customer;
    public $history;
    public $comments;

    public function __construct(
        int $id,
        string $name,
        ?string $manager,
        string $status,
        string $customer,
        array $history,
    array $comments
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->manager  = $manager;
        $this->status   = $status;
        $this->customer = $customer;
        $this->history  = $history;
        $this->comments = $comments;
    }
}