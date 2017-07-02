<?php

namespace AMP\Service\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Part;
use AMP\Map\ViewModelMapperInterface;
use AMP\Team;
use Illuminate\Validation\UnauthorizedException;

class PartService implements PartServiceInterface
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
        $parts = Part::where('team_id', $teamId)->get();

        $viewModels = [];
        foreach ($parts as $part) {
            $viewModels[] = $this->listMapper->map($part);
        }

        return $viewModels;
    }

    public function createFromJson(string $json, Team $team): Part
    {
        /** @var Part $part */
        $part = new Part();
        $part->team()->associate($team);
        $part = $this->jsonConverter->convert($part, $json);

        $part->save();

        return $part;
    }

    public function updateFromJson(string $json, int $id): Part
    {
        /** @var Part $part */
        $part = Part::find($id);
        $part = $this->jsonConverter->convert($part, $json);

        $part->save();

        return $part;
    }

    public function getPart(int $id, int $teamId): Part
    {
        /** @var Part $part */
        $part = Part::find($id);

        if ($part->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's parts.");
        }

        return $part;
    }
}