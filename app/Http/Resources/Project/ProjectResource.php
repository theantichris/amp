<?php

namespace AMP\Http\Resources\Project;

use AMP\Domain\Project\Project;
use AMP\Http\Resources\Customer\CustomerResource;
use AMP\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
{
    public function toArray($request)
    {
        /** @var Project $this */

        return [
            'id'       => $this->id,
            'status'   => $this->status,
            'customer' => $this->customer ? new CustomerResource($this->customer) : 'Internal',
            'name'     => $this->name,
            'manager'  => new UserResource($this->manager),
        ];
    }
}