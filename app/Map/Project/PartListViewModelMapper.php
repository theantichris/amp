<?php

namespace AMP\Map\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Part;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Project\PartListViewModel;
use AMP\ViewModel\ViewModel;

class PartListViewModelMapper implements ViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Part $model */
        $viewModel = new PartListViewModel(
            $model->getId(),
            $model->getName(),
            $model->getQuantity() ?? null,
            $model->material()->getName() ?? null
        );

        return $viewModel;
    }
}