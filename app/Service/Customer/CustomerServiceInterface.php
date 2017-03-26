<?php

namespace AMP\Service\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Team;

interface CustomerServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function createFromJson(string $json, Team $team): Customer;

    public function updateFromJson(string $json, int $id): Customer;

    public function getCustomer(int $id, int $teamId): Customer;
}