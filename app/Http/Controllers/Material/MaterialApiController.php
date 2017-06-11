<?php

namespace AMP\Http\Controllers\Material;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Material\MaterialServiceInterface;
use AMP\Team;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class MaterialApiController extends BaseApiController
{
    private $materialService;

    public function __construct(MaterialServiceInterface $materialService)
    {
        $this->middleware('auth');

        $this->materialService = $materialService;
    }

    public function index(): JsonResponse
    {
        $materials = $this->materialService->getListViewModels($this->getTeam()->getQueueableId());

        return Response::json([
            'materials' => $materials,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        $material = $this->materialService->createFromJson($json, $team);

        return Response::json([], 201, [
            'Location' => '/materials/' . $material->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->materialService->updateFromJson($json, $id);

        return Response::json([], 204);
    }

    public function show(int $id): JsonResponse
    {
        $material = $this->materialService->getMaterial($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'material' => $material,
        ]);
    }
}
