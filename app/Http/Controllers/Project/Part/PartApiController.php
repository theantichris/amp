<?php

namespace AMP\Http\Controllers\Project\Part;

use AMP\Domain\Project\Part\Part;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\Part\PartResource;
use AMP\Service\Project\Part\PartServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class PartApiController extends BaseApiController
{
    private $partService;

    public function __construct(Auth $auth, PartServiceInterface $partService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->partService = $partService;
    }

    public function index(int $projectId): ResourceCollection
    {
        $parts = Part::whereProjectId($projectId)->get();

        return PartResource::collection($parts);
    }

    public function create(Request $request, int $projectId): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $part = $this->partService->createFromJson(
            $projectId,
            $request->getContent()
        );

        return new JsonResponse([], 201, [
            'Location' => '/projects/parts' . $part->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->partService->updateFromJson(
            $request->getContent(),
            $id
        );

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $projectId, int $id): PartResource
    {
        $part = Part::whereProjectId($projectId)->find($id);

        return new PartResource($part);
    }
}
