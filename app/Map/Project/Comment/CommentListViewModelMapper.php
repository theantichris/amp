<?php

namespace AMP\Map\Project\Comment;

use AMP\ViewModel\Project\Comment\CommentListViewModel;
use AMP\ViewModel\ViewModel;
use BrianFaust\Commentable\Models\Comment;

class CommentListViewModelMapper
{
    public function map(Comment $comment): ViewModel
    {
        $comment = new CommentListViewModel(
            $comment->id,
            $comment->creator->name,
            $comment->updated_at->getTimestamp() * 1000,
            $comment->body
        );

        return $comment;
    }
}