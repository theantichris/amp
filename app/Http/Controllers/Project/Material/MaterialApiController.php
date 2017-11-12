<?php

namespace AMP\Http\Controllers\Project\Material;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Project\Material\MaterialServiceInterface;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

    public function index(): JsonResponse
    {
        $materials = $this->materialService->getListViewModels($this->getTeam()->getQueueableId());

        return new JsonResponse([
            'materials' => $materials,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @noinspection PhpUndefinedMethodInspection */
        $team = Auth::user()->currentTeam();

        $material = $this->materialService->createFromJson($json, $team);

        return new JsonResponse([
            'Location' => '/materials/' . $material->getId(),
        ], Response::HTTP_CREATED);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->materialService->updateFromJson($json, $id);

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function show(int $id): JsonResponse
    {
        $material = $this->materialService->getMaterial($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'material' => $material,
        ]);
    }
}
