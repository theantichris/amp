<?php

namespace AMP\Map\Customer;

use AMP\Domain\Customer\Customer;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Customer\CustomerListViewModel;
use AMP\ViewModel\ViewModel;
use Illuminate\Database\Eloquent\Model;

class CustomerListViewModelMapper implements ViewModelMapperInterface
{
    public function map(Model $model): ViewModel
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