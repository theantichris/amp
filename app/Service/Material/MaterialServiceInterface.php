<?php

namespace AMP\Service\Material;

use AMP\Domain\Material\Material;
use AMP\Team;

interface MaterialServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Material;

    public function updateFromJson(string $json, int $id): Material;

    public function getMaterial(int $id, int $teamId): Material;
}