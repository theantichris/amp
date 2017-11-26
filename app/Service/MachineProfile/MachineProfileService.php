<?php

namespace AMP\Service\MachineProfile;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Map\ListViewModelMapperInterface;
use AMP\Team;
use Illuminate\Validation\UnauthorizedException;

class MachineProfileService implements MachineProfileServiceInterface
{
    private $listMapper;
    private $jsonConverter;

    public function __construct(
        ListViewModelMapperInterface $listMapper,
        JsonConverterInterface $jsonConverter
    ) {
        $this->listMapper    = $listMapper;
        $this->jsonConverter = $jsonConverter;
    }

    public function getListViewModels(int $teamId): array
    {
        $machineProfiles = MachineProfile::where('team_id', $teamId)->get();

        $viewModels = [];
        foreach ($machineProfiles as $material) {
            $viewModels[] = $this->listMapper->map($material);
        }

        return $viewModels;
    }

    public function createFromJson(string $json, Team $team): MachineProfile
    {
        /** @var MachineProfile $machineProfile */
        $machineProfile = new MachineProfile();
        $machineProfile->team()->associate($team);
        $machineProfile = $this->jsonConverter->convert($machineProfile, $json);

        $machineProfile->save();

        return $machineProfile;
    }

    public function updateFromJson(string $json, int $id): MachineProfile
    {
        /** @var MachineProfile $machineProfile */
        $machineProfile = MachineProfile::find($id);
        $machineProfile = $this->jsonConverter->convert($machineProfile, $json);

        $machineProfile->save();

        return $machineProfile;
    }

    public function getMachineProfile(int $id, int $teamId): MachineProfile
    {
        /** @var MachineProfile $machineProfile */
        $machineProfile = MachineProfile::find($id);

        if ($machineProfile->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's machine profiles.");
        }

        return $machineProfile;
    }
}