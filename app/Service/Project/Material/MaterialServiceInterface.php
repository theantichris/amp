<?php

namespace AMP\Service\Project\Material;

use AMP\Domain\Project\Material\Material;
use AMP\Team;

interface MaterialServiceInterface
{
    public function createFromJson(string $json, Team $team): Material;

    public function updateFromJson(string $json, int $id): Material;
}