<?php

namespace AMP\Map\Customer;

use AMP\Domain\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Customer\CustomerListViewModel;
use AMP\ViewModel\ViewModel;

class CustomerListViewModelMapper implements ViewModelMapperInterface
{
    public function map(Model $model): ViewModel
    {
        /** @var Customer $model */
        $model = new CustomerListViewModel(
            $model->getId(),
            $model->getAccountNumber(),
            $model->getCompanyName(),
            $model->getContactName(),
            $model->getContactEmail()
        );

        return $model;
    }
}