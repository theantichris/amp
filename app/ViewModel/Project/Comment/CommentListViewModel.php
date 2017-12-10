<?php

namespace AMP\ViewModel\Project\Comment;

use AMP\ViewModel\ViewModel;

class CommentListViewModel extends ViewModel
{
    public $id;
    public $createdBy;
    public $updatedAt;
    public $body;

    public function __construct(int $id, string $createdBy, int $updatedAt, string $body)
    {
        $this->id        = $id;
        $this->createdBy = $createdBy;
        $this->updatedAt = $updatedAt;
        $this->body      = $body;
    }
}