<?php

namespace AMP\Service\Project\Material;

use AMP\Domain\Project\Material\Material;
use AMP\Team;

class EloquentMaterialService implements MaterialServiceInterface
{
    public function createFromJson(string $json, Team $team): Material
    {
        $material = new Material();
        $material->team()->associate($team);

        $data = json_decode($json, true);
        $material->fill($data)->save();

        return $material;
    }

    public function updateFromJson(string $json, int $id): Material
    {
        $material = Material::find($id);
        $data     = json_decode($json, true);
        $material->update($data);

        return $material;
    }
}