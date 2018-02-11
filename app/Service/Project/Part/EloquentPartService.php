<?php

namespace AMP\Service\Project\Part;

use AMP\Domain\Project\Part\Part;
use AMP\Team;

class EloquentPartService implements PartServiceInterface
{
    public function createFromJson(string $json, Team $team): Part
    {
        $part = new Part();
        $part->team()->associate($team);

        $data = json_decode($json, true);
        $part->fill($data)->save();

        return $part;
    }

    public function updateFromJson(string $json, int $id): Part
    {
        $part = Part::find($id);
        $data     = json_decode($json, true);
        $part->update($data);

        return $part;
    }
}