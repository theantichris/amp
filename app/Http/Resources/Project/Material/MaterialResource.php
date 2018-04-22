<?php

namespace AMP\Http\Resources\Project\Material;

use AMP\Domain\Project\Material\Material;
use Illuminate\Http\Resources\Json\Resource;

class MaterialResource extends Resource
{
    public function toArray($request)
    {
        /** @var Material $this */

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'cost'         => $this->cost,
            'weight_unit'  => $this->weight_unit,
            'density'      => $this->density,
            'density_unit' => $this->density_unit,
            'deleted_at'   => $this->deleted_at,
        ];
    }
}