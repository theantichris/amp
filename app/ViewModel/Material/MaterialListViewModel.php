<?php

namespace AMP\ViewModel\Material;

use AMP\ViewModel\ViewModel;

class MaterialListViewModel extends ViewModel
{
    public $id;
    public $name;
    public $cost;
    public $density;

    public function __construct(
        int $id,
        string $name,
        string $cost,
        string $density
    ) {
        $this->id      = $id;
        $this->name    = $name;
        $this->cost    = $cost;
        $this->density = $density;
    }
}