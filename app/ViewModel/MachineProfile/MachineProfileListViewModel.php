<?php

namespace AMP\ViewModel\MachineProfile;

use AMP\ViewModel\ViewModel;

class MachineProfileListViewModel extends ViewModel
{
    public $id;
    public $type;
    public $setupFee;
    public $rate;

    public function __construct(int $id, string $type, float $setupFee, float $rate)
    {
        $this->id       = $id;
        $this->type     = $type;
        $this->setupFee = $setupFee;
        $this->rate     = $rate;
    }
}