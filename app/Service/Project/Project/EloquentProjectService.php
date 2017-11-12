<?php

namespace AMP\Service\Project\Project;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Project;
use AMP\Map\ViewModelMapperInterface;
use AMP\Team;
use AMP\User;
use Illuminate\Validation\UnauthorizedException;

class EloquentProjectService implements ProjectServiceInterface
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

        $data = json_decode($json);

        if ($data->customer) {
            $customer = Customer::find($data->customer->id);
            $project->customer()->associate($customer);
        }

        $manager = User::find($data->manager->id);
        $project->manager()->associate($manager);

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

    public function getProject(int $id, int $teamId): Project
    {
        /** @var Project $project */
        $project = Project::find($id);

        if ($project->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's projects.");
        }

        return $project;
    }
}