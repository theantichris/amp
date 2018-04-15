<?php

namespace AMP\Service\Project;

use AMP\Domain\Project\Project;
use AMP\Team;

interface ProjectServiceInterface
{
    public function createFromJson(string $json, Team $team): Project;

    public function updateFromJson(string $json, int $id): Project;
}