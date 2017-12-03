<?php

namespace AMP\Http\Controllers\Project\Comment;

use AMP\Domain\Project\Project;
use AMP\Http\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentApiController extends BaseApiController
{
    public function create(int $projectId, Request $request): JsonResponse
    {
        $json    = $request->getContent();
        $comment = json_decode($json, true);

        $project = Project::find($projectId);
        $project->comment($comment, $this->auth->user());

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}