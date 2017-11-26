<?php

namespace AMP\Map\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Project;
use AMP\Map\ListViewModelMapperInterface;
use AMP\ViewModel\Project\ProjectListViewModel;
use AMP\ViewModel\ViewModel;

class ProjectListListViewModelMapperInterface implements ListViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Project $model */

        if ($model->getCustomer()) {
            $customer = $model->getCustomer()->getCompanyName();
        } else {
            $customer = 'Internal';
        }

        $viewModel = new ProjectListViewModel(
            $model->getId(),
            $model->getName(),
            $model->getManager()->getName(),
            $model->getStatus(),
            $customer
        );

        return $viewModel;
    }
}