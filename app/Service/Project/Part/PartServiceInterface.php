<?php

namespace AMP\Service\Project\Part;

use AMP\Domain\Project\Part\Part;
use AMP\Team;

interface PartServiceInterface
{
    public function createFromJson(string $json, Team $team): Part;

    public function updateFromJson(string $json, int $id): Part;
}