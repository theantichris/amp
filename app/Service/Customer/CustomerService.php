<?php

namespace AMP\Service\Customer;

use AMP\Repository\RepositoryInterface;
use AMP\Map\ViewModelMapperInterface;

class CustomerService
{
    private $repo;
    private $listMapper;

    public function __construct(RepositoryInterface $repo, ViewModelMapperInterface $listMapper)
    {
        $this->repo       = $repo;
        $this->listMapper = $listMapper;
    }

    public function getListViewModels(int $teamId): array
    {
        $customers = $this->repo->findBy('team_id', $teamId);

        $viewModels = [];
        foreach ($customers as $customer) {
            $viewModels[] = $this->listMapper->map($customer);
        }

        return $viewModels;
    }
}