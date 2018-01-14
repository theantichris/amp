<?php

namespace AMP\Service\MachineProfile;

use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Team;

interface MachineProfileServiceInterface
{
    public function createFromJson(string $json, Team $team): MachineProfile;

    public function updateFromJson(string $json, int $id): MachineProfile;
}