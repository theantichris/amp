<?php

namespace AMP\Service\Project;

use AMP\Domain\Project\Material;
use AMP\Team;

interface MaterialServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Material;

    public function updateFromJson(string $json, int $id): Material;

    public function getMaterial(int $id, int $teamId): Material;
}