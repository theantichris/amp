<?php

namespace AMP\Domain\Material;

use AMP\Domain\BaseModel;

class Material extends BaseModel
{
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): Material
    {
        $this->attributes['name'] = $name;

        return $this;
    }

    public function getCost(): float
    {
        return $this->attributes['cost'];
    }

    public function setCost(float $cost): Material
    {
        $this->attributes['cost'] = $cost;

        return $this;
    }
}