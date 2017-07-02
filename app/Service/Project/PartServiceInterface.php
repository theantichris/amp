<?php

namespace AMP\Service\Project;

use AMP\Domain\Project\Part;
use AMP\Team;

interface PartServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Part;

    public function updateFromJson(string $json, int $id): Part;

    public function getPart(int $id, int $teamId): Part;
}