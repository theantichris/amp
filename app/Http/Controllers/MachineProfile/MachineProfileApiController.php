<?php

namespace AMP\Http\Controllers\MachineProfile;

use AMP\Http\Controllers\BaseApiController;
use AMP\Service\MachineProfile\MachineProfileServiceInterface;
use AMP\Team;
use Auth;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class MachineProfileApiController extends BaseApiController
{
    private $machineProfileService;

    public function __construct(Factory $auth, MachineProfileServiceInterface $machineProfileService)
    {
        $this->middleware('auth');

        parent::__construct($auth);

        $this->machineProfileService = $machineProfileService;
    }

    public function index(): JsonResponse
    {
        $machineProfiles = $this->machineProfileService->getListViewModels($this->getTeam()->getQueueableId());

        return Response::json([
            'machineProfiles' => $machineProfiles,
        ]);
    }

    public function create(Request $request): JsonResponse
    {
        $json = $request->getContent();

        /** @var Team $team */
        $team = Auth::user()->currentTeam();

        $machineProfile = $this->machineProfileService->createFromJson($json, $team);

        return Response::json([], 201, [
            'Location' => '/machine-profiles/' . $machineProfile->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $json = $request->getContent();
        $this->machineProfileService->updateFromJson($json, $id);

        return Response::json([], 204);
    }

    public function show(int $id): JsonResponse
    {
        $machineProfile = $this->machineProfileService->getMachineProfile($id, $this->getTeam()->getQueueableId());

        return new JsonResponse([
            'machineProfile' => $machineProfile,
        ]);
    }
}
