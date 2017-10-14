<?php

namespace AMP\Map\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Project;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Project\ProjectListViewModel;
use AMP\ViewModel\ViewModel;

class ProjectListViewModelMapper implements ViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Project $model */

        if ($model->customer()) {
            $customer = $model->customer()->getCompanyName();
        } else {
            $customer = 'Internal';
        }

        $viewModel = new ProjectListViewModel(
            $model->getId(),
            $model->getName(),
            $model->getManager(),
            $model->getStatus(),
            $customer
        );

        return $viewModel;
    }
}