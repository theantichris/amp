<?php

namespace AMP\Http\Resources\Project\Part;

use AMP\Domain\Project\Part\Part;
use AMP\Http\Resources\Project\Material\MaterialResource;
use Illuminate\Http\Resources\Json\Resource;

class PartResource extends Resource
{
    public function toArray($request)
    {
        /** @var Part $this */

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'quantity'     => $this->quantity,
            'requirements' => $this->requirements,
            'description'  => $this->description,
            'urls'         => $this->urls,
            'material'     => new MaterialResource($this->material),
        ];
    }
}