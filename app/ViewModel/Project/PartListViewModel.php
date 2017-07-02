<?php

namespace AMP\ViewModel\Project;

use AMP\ViewModel\ViewModel;

class PartListViewModel extends ViewModel
{
    public $id;
    public $name;
    public $quantity;
    public $material;

    public function __construct(
        int $id,
        string $name,
        ?int $quantity,
        ?string $material
    ) {
        $this->id       = $id;
        $this->name     = $name;
        $this->quantity = $quantity;
        $this->material = $material;
    }
}