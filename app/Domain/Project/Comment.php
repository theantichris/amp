<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends BaseModel
{
    public function setComment(string $comment): Comment
    {
        $this->attributes['comment'] = $comment;

        return $this;
    }

    public function getComment(): string
    {
        return $this->attributes['comment'];
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}