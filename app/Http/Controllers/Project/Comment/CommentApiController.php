<?php

namespace AMP\Http\Controllers\Project\Comment;

use AMP\Domain\Project\Project;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\Comment\CommentResource;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class CommentApiController extends BaseApiController
{
    public function __construct(Auth $auth)
    {
        $this->middleware('auth');

        parent::__construct($auth);
    }

    public function index(int $projectId): ResourceCollection
    {
        $comments = Project::with('comments.creator')->find($projectId)->comments;

        return CommentResource::collection($comments);
    }

    public function create(int $projectId, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $data = json_decode($json, true);

        Project::find($projectId)->comment($data, $this->auth->user());

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}
