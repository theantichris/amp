<?php

namespace AMP\Http\Controllers\Project;

use AMP\Domain\Project\Project;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\ProjectResource;
use AMP\Service\Project\ProjectServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
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

    public function index(): ResourceCollection
    {
        $projects = Project::whereTeamId($this->getTeam()->getQueueableId())->get();

        return ProjectResource::collection($projects);
    }

    public function create(Request $request): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $project = $this->projectService->createFromJson(
            $request->getContent(),
            $this->auth->user()->currentTeam()
        );

        return new JsonResponse([], 201, [
            'Location' => '/machine-profiles/' . $project->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->projectService->updateFromJson(
            $request->getContent(),
            $id
        );

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): ProjectResource
    {
        $project = Project::with('parts')->find($id);

        return new ProjectResource($project);
    }
}
