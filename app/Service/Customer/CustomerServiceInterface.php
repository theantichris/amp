<?php

namespace AMP\Service\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Team;

interface CustomerServiceInterface
{
    public function getListViewModels(int $teamId): array;

    public function saveFromJson(string $json, Team $team): Customer;

    public function getCustomer(int $id): Customer;
}