<?php

namespace AMP\Service\Project;

use AMP\Domain\Project\Project;
use AMP\Team;
use AMP\ViewModel\Project\ProjectDetailViewModel;

interface ProjectServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Project;

    public function updateFromJson(string $json, int $id): Project;

    public function getProjectDetailViewModel(int $id, int $teamId): ProjectDetailViewModel;
}