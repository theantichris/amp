<?php

namespace AMP\Http\Resources\Project;

use AMP\Domain\Project\Project;
use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
{
    public function toArray($request)
    {
        /** @var Project $this */

        return [
            'id'       => $this->id,
            'status'   => $this->status,
            'customer' => $this->customer ?? 'Internal',
            'name'     => $this->name,
            'manager'  => $this->manager,
        ];
    }
}