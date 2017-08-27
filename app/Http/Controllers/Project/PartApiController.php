<?php

namespace AMP\Http\Controllers\Project;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\Project\PartServiceInterface;
use AMP\Team;
use Auth;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class PartApiController extends BaseApiController
{
    private $partService;

    public function __construct(Factory $auth, PartServiceInterface $partService)
    {
        $this->middleware('auth');

        parent::__construct($auth);
        
        $this->partService = $partService;
    }

    public function index(): JsonResponse
    {
        $parts = $this->partService->getListViewModels($this->getTeam()->getQueueableId());

        return Response::json([
            'parts' => $parts,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        $part = $this->partService->createFromJson($json, $team);

        return Response::json([], 201, [
            'Location' => '/parts/' . $part->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->partService->updateFromJson($json, $id);

        return Response::json([], 204);
    }

    public function show(int $id): JsonResponse
    {
        $part = $this->partService->getPart($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'part' => $part,
        ]);
    }
}
