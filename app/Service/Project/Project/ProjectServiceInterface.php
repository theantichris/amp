<?php

namespace AMP\Service\Project\Project;

use AMP\Domain\Project\Project;
use AMP\Team;

interface ProjectServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Project;

    public function updateFromJson(string $json, int $id): Project;

    public function getProject(int $id, int $teamId): Project;
}