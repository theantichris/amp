<?php

namespace AMP\Service\Customer;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use AMP\Map\ViewModelMapperInterface;
use AMP\Repository\RepositoryInterface;
use AMP\Team;

class CustomerService implements CustomerServiceInterface
{
    private $repo;
    private $listMapper;
    private $jsonConverter;

    public function __construct(
        RepositoryInterface $repo,
        ViewModelMapperInterface $listMapper,
        JsonConverterInterface $jsonConverter
    ) {
        $this->repo          = $repo;
        $this->listMapper    = $listMapper;
        $this->jsonConverter = $jsonConverter;
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

    public function saveFromJson(string $json, Team $team): Customer
    {
        /** @var Customer $customer */
        $customer = $this->jsonConverter->convert($json, $team);
        $this->repo->save($customer);

        return $customer;
    }

    public function getCustomer(int $id): Customer
    {
        /** @var Customer $customer */
        $customer = $this->repo->find($id);

        return $customer;
    }
}