<?php

namespace AMP\Service\User;

interface UserServiceInterface
{
    public function getListViewModels(int $teamId): array;
}