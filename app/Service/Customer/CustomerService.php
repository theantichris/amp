<?php

namespace AMP\Service\Customer;

use AMP\Converter\JsonConverterInterface;
use AMP\Domain\Customer\Customer;
use AMP\Map\ListViewModelMapperInterface;
use AMP\Repository\RepositoryInterface;
use AMP\Team;
use Illuminate\Validation\UnauthorizedException;

class CustomerService implements CustomerServiceInterface
{
    private $repo;
    private $listMapper;
    private $jsonConverter;

    public function __construct(
        RepositoryInterface $repo,
        ListViewModelMapperInterface $listMapper,
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

    public function createFromJson(string $json, Team $team): Customer
    {
        /** @var Customer $customer */
        $customer = new Customer();
        $customer->team()->associate($team);
        $customer = $this->jsonConverter->convert($customer, $json);

        $this->repo->save($customer);

        return $customer;
    }

    public function updateFromJson(string $json, int $id): Customer
    {
        /** @var Customer $customer */
        $customer = $this->repo->find($id);
        $customer = $this->jsonConverter->convert($customer, $json);

        $this->repo->save($customer);

        return $customer;
    }

    public function getCustomer(int $id, int $teamId): Customer
    {
        /** @var Customer $customer */
        $customer = $this->repo->find($id);

        if ($customer->getTeamId() !== $teamId) {
            throw new UnauthorizedException("You do not have access to this team's customers.");
        }

        return $customer;
    }
}