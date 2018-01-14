<?php

namespace AMP\Http\Controllers\Project\Material;

use AMP\Domain\Project\Material\Material;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\Project\Material\MaterialResource;
use AMP\Service\Project\Material\MaterialServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class MaterialApiController extends BaseApiController
{
    private $materialService;

    public function __construct(Auth $auth, MaterialServiceInterface $materialService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->materialService = $materialService;
    }

    public function index(): ResourceCollection
    {
        $materials = Material::whereTeamId($this->getTeam()->getQueueableId())->get();

        return MaterialResource::collection($materials);
    }

    public function create(Request $request): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $material = $this->materialService->createFromJson(
            $request->getContent(),
            $this->auth->user()->currentTeam()
        );

        return new JsonResponse([], 201, [
            'Location' => '/machine-profiles/' . $material->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->materialService->updateFromJson(
            $request->getContent(),
            $id
        );

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): MaterialResource
    {
        $material = Material::find($id);

        return new MaterialResource($material);
    }
}
