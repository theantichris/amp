<?php

namespace AMP\Map\Project\Material;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Material\Material;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Project\Material\MaterialListViewModel;
use AMP\ViewModel\ViewModel;

class MaterialListViewModelMapper implements ViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var Material $model */
        $viewModel = new MaterialListViewModel(
            $model->getId(),
            $model->getName(),
            '$' . number_format($model->getCost(), 2) . ' ' . $model->getWeightUnit(),
            number_format($model->getDensity(), 2) . ' ' . $model->getDensityUnit()
        );

        return $viewModel;
    }
}