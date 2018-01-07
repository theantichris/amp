<?php

namespace AMP\Http\Resources;

use AMP\User;
use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    public function toArray($request): array
    {
        /** @var User $this */

        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
