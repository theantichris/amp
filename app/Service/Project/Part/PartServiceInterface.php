<?php

namespace AMP\Service\Project\Part;

use AMP\Domain\Project\Part\Part;

interface PartServiceInterface
{
    public function createFromJson(int $projectId, string $json): Part;

    public function updateFromJson(string $json, int $id): Part;
}