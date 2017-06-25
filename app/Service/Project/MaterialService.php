<?php

namespace AMP\Service\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Material;
use AMP\Map\ViewModelMapperInterface;
use AMP\Team;
use Illuminate\Validation\UnauthorizedException;

class MaterialService implements MaterialServiceInterface
{
    private $listMapper;
    private $jsonConverter;

    public function __construct(
        ViewModelMapperInterface $listMapper,
        JsonConverterInterface $jsonConverter
    ) {
        $this->listMapper    = $listMapper;
        $this->jsonConverter = $jsonConverter;
    }

    public function getListViewModels(int $teamId): array
    {
        $materials = Material::where('team_id', $teamId)->get();

        $viewModels = [];
        foreach ($materials as $material) {
            $viewModels[] = $this->listMapper->map($material);
        }

        return $viewModels;
    }

    public function createFromJson(string $json, Team $team): Material
    {
        /** @var Material $material */
        $material = new Material();
        $material->team()->associate($team);
        $material = $this->jsonConverter->convert($material, $json);

        $material->save();

        return $material;
    }

    public function updateFromJson(string $json, int $id): Material
    {
        /** @var Material $material */
        $material = Material::find($id);
        $material = $this->jsonConverter->convert($material, $json);

        $material->save();

        return $material;
    }

    public function getMaterial(int $id, int $teamId): Material
    {
        /** @var Material $material */
        $material = Material::find($id);

        if ($material->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's materials.");
        }

        return $material;
    }
}