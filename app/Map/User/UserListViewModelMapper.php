<?php

namespace AMP\Map\User;

use AMP\User;
use AMP\ViewModel\User\UserListViewModel;
use AMP\ViewModel\ViewModel;

class UserListViewModelMapper
{
    public function map(User $user): ViewModel
    {
        $viewModel = new UserListViewModel(
            $user->getId(),
            $user->getName()
        );

        return $viewModel;
    }
}