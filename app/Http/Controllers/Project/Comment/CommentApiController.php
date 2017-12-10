<?php

namespace AMP\Http\Controllers\Project\Comment;

use AMP\Domain\Project\Project;
use AMP\Http\Controllers\BaseApiController;
use AMP\Map\Project\Comment\CommentListViewModelMapper;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentApiController extends BaseApiController
{
    private $listMapper;

    public function __construct(Auth $auth, CommentListViewModelMapper $listMapper)
    {
        parent::__construct($auth);

        $this->listMapper = $listMapper;
    }

    public function index(int $projectId): JsonResponse
    {
        $project  = Project::with('comments.creator')->find($projectId);
        $comments = $project->comments;

        $models = [];
        foreach ($comments as $comment) {
            $models[] = $this->listMapper->map($comment);
        }

        return new JsonResponse([
            'comments' => $models,
        ]);
    }

    public function create(int $projectId, Request $request): JsonResponse
    {
        // TODO: Break out into service.

        $json    = $request->getContent();
        $comment = json_decode($json, true);

        /** @noinspection PhpUndefinedMethodInspection */
        Project::find($projectId)->comment($comment, $this->auth->user());

        return new JsonResponse([], Response::HTTP_CREATED);
    }
}