<?php

namespace AMP\Service\Project\Part;

use AMP\Domain\Project\Part\Part;
use AMP\Domain\Project\Project;

class EloquentPartService implements PartServiceInterface
{
    public function createFromJson(int $projectId, string $json): Part
    {
        $data    = json_decode($json, true);
        $project = Project::find($projectId);

        $part = new Part();
        $part->team()->associate($project->team);
        $part->fill($data);

        $project->parts()->save($part);

        return $part;
    }

    public function updateFromJson(string $json, int $id): Part
    {
        $part = Part::find($id);
        $data = json_decode($json, true);
        $part->update($data);

        return $part;
    }
}