<?php

namespace AMP\Map\Customer;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Customer\CustomerListViewModel;
use AMP\ViewModel\ViewModel;

class CustomerListViewModelMapper implements ViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Customer $model */
        $viewModel = new CustomerListViewModel(
            $model->getId(),
            $model->getAccountNumber(),
            $model->getCompanyName(),
            $model->getContactName(),
            $model->getContactEmail()
        );

        return $viewModel;
    }
}