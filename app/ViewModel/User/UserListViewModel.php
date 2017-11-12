<?php

namespace AMP\ViewModel\User;

use AMP\ViewModel\ViewModel;

class UserListViewModel extends ViewModel
{
    public $id;
    public $name;

    public function __construct(int $id, string $name)
    {
        $this->id   = $id;
        $this->name = $name;
    }
}