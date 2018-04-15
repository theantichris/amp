<?php

namespace AMP\Http\Resources\Project\Comment;

use BrianFaust\Commentable\Models\Comment;
use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
{
    public function toArray($request)
    {
        /** @var Comment $this */

        return [
            'id'         => $this->id,
            'creator'    => $this->creator,
            'updated_at' => $this->updated_at,
            'body'       => $this->body,
        ];
    }
}