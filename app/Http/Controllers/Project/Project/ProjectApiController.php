<?php

namespace AMP\Http\Controllers\Project\Project;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Project\Project\ProjectServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectApiController extends BaseApiController
{
    private $projectService;

    public function __construct(Auth $auth, ProjectServiceInterface $projectService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->projectService = $projectService;
    }

    public function index(): JsonResponse
    {
        $projects = $this->projectService->getListViewModels($this->getTeam()->getQueueableId());

        return new JsonResponse([
            'projects' => $projects,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @noinspection PhpUndefinedMethodInspection */
        $team = Auth::user()->currentTeam();

        $project = $this->projectService->createFromJson($json, $team);

        return new JsonResponse([
            'Location' => 'projects/' . $project->getId(),
        ], Response::HTTP_CREATED);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->projectService->updateFromJson($json, $id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): JsonResponse
    {
        $project = $this->projectService->getProject($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'project' => $project,
        ]);
    }
}
