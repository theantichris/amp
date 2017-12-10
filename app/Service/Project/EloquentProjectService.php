<?php

namespace AMP\Service\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Project\Project;
use AMP\Map\DetailViewModelMapperInterface;
use AMP\Map\ListViewModelMapperInterface;
use AMP\Team;
use AMP\ViewModel\Project\ProjectDetailViewModel;
use Illuminate\Validation\UnauthorizedException;

class EloquentProjectService implements ProjectServiceInterface
{
    private $listMapper;
    private $jsonConverter;
    private $detailMapper;

    public function __construct(
        ListViewModelMapperInterface $listMapper,
        JsonConverterInterface $jsonConverter,
        DetailViewModelMapperInterface $detailMapper
    ) {
        $this->listMapper    = $listMapper;
        $this->jsonConverter = $jsonConverter;
        $this->detailMapper  = $detailMapper;
    }

    public function getListViewModels(int $teamId): array
    {
        /** @noinspection PhpUndefinedMethodInspection */
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
        $project = Project::find($id);
        $project = $this->jsonConverter->convert($project, $json);

        $project->save();

        return $project;
    }

    public function getProjectDetailViewModel(int $id, int $teamId): ProjectDetailViewModel
    {
        /** @var Project $project */
        $project = Project::with(['customer', 'manager', 'audits.user'])->find($id);

        if ($project->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's projects.");
        }

        /** @var ProjectDetailViewModel $model */
        $model = $this->detailMapper->map($project);

        return $model;
    }
}