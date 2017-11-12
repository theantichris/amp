<?php

namespace AMP\Service\User;

use AMP\Map\User\UserListViewModelMapper;
use AMP\Team;

class EloquentUserService implements UserServiceInterface
{
    private $listMapper;

    public function __construct(UserListViewModelMapper $listMapper)
    {
        $this->listMapper = $listMapper;
    }

    public function getListViewModels(int $teamId): array
    {
        /** @var Team $team */
        $team  = Team::find($teamId);
        $users = $team->users;

        $viewModels = [];
        foreach ($users as $user) {
            $viewModels[] = $this->listMapper->map($user);
        }

        return $viewModels;
    }
}