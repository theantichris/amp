<?php

namespace AMP\Service\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Map\ViewModelMapperInterface;
use AMP\Repository\RepositoryInterface;
use AMP\Team;

class CustomerService implements CustomerServiceInterface
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

    public function saveFromJson(string $json, Team $team): Customer
    {
        // TODO: Converter.

        $data = json_decode($json);

        $customer = new Customer();

        $customer->setAccountNumber($data->accountNumber)
                 ->setCompanyName($data->companyName)
                 ->setContactName($data->contactName)
                 ->setContactEmail($data->contactEmail);

        $team->customers()->save($customer);

        return $customer;
    }
}