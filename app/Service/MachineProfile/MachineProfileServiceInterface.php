<?php

namespace AMP\Service\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Team;

interface MachineProfileServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): MachineProfile;

    public function updateFromJson(string $json, int $id): MachineProfile;

    public function getMachineProfile(int $id, int $teamId): MachineProfile;
}