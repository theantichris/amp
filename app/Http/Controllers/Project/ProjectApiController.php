<?php

namespace AMP\Http\Controllers\Project;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Project\ProjectService;
use AMP\Service\Project\ProjectServiceInterface;
use AMP\Team;
use Auth;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class ProjectApiController extends BaseApiController
{
    private $projectService;

    public function __construct(Factory $auth, ProjectService $projectService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->projectService = $projectService;
    }

    public function index(): JsonResponse
    {
        $projects = $this->projectService->getListViewModels($this->getTeam()->getQueueableId());

        return Response::json([
            'projects' => $projects,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        $project = $this->projectService->createFromJson($json, $team);

        return Response::json([], 201, [
            'Location' => '/projects/' . $project->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->projectService->updateFromJson($json, $id);

        return Response::json([], 204);
    }

    public function show(int $id): JsonResponse
    {
        $project = $this->projectService->getProject($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'project' => $project,
        ]);
    }
}
