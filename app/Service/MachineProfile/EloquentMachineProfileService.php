<?php

namespace AMP\Service\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Team;

class EloquentMachineProfileService implements MachineProfileServiceInterface
{
    public function createFromJson(string $json, Team $team): MachineProfile
    {
        $machineProfile = new MachineProfile();
        $machineProfile->team()->associate($team);
        $data = json_decode($json, true);
        $machineProfile->fill($data)->save();

        return $machineProfile;
    }

    public function updateFromJson(string $json, int $id): MachineProfile
    {
        $machineProfile = MachineProfile::find($id);
        $data           = json_decode($json, true);
        $machineProfile->update($data);

        return $machineProfile;
    }
}