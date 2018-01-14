<?php

namespace AMP\Http\Controllers\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Http\Controllers\BaseApiController;
use AMP\Http\Resources\MachineProfile\MachineProfileCollection;
use AMP\Http\Resources\MachineProfile\MachineProfileResource;
use AMP\Service\MachineProfile\MachineProfileServiceInterface;
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

    public function index(): MachineProfileCollection
    {
        $machineProfiles = MachineProfile::whereTeamId($this->getTeam()->getQueueableId())->get();

        return new MachineProfileCollection($machineProfiles);
    }

    public function create(Request $request): JsonResponse
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $machineProfile = $this->machineProfileService->createFromJson(
            $request->getContent(),
            $this->auth->user()->currentTeam()
        );

        return Response::json([], 201, [
            'Location' => '/machine-profiles/' . $machineProfile->getId(),
        ]);
    }

    public function update(int $id, Request $request): JsonResponse
    {
        $this->machineProfileService->updateFromJson($request->getContent(), $id);

        return Response::json([], 204);
    }

    public function show(int $id): MachineProfileResource
    {
        $machineProfile = MachineProfile::find($id);

        return new MachineProfileResource($machineProfile);
    }
}
