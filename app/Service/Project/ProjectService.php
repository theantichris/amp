<?php

namespace AMP\Service\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Project;
use AMP\Map\ViewModelMapperInterface;
use AMP\Team;
use Illuminate\Validation\UnauthorizedException;

class ProjectService
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
        $projects = Project::whereTeamId($teamId)->get();

        $viewModels = [];
        foreach ($projects as $project) {
            $viewModels[] = $this->listMapper->map($project);
        }

        return $viewModels;
    }

    public function createFromJson(string $json, Team $team): Project
    {
        /** @var Project $project */
        $project = new Project();
        $project->team()->associate($team);
        $project = $this->jsonConverter->convert($project, $json);

        $project->save();

        return $project;
    }

    public function updateFromJson(string $json, int $id): Project
    {
        /** @var Project $project */
        $project = Project::whereId($id)->get();
        $project = $this->jsonConverter->convert($project, $json);

        $project->save();

        return $project;
    }

    public function getProject(int $id, int $teamId): Project
    {
        /** @var Project $project */
        $project = Project::whereId($id)->get();

        if ($project->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's projects.");
        }

        return $project;
    }
}