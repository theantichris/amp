<?php

namespace AMP\Map\Material;

use AMP\Domain\Material\Material;
use AMP\Map\ViewModelMapperInterface;
use AMP\ViewModel\Material\MaterialListViewModel;
use AMP\ViewModel\ViewModel;
use Illuminate\Database\Eloquent\Model;

class MaterialListViewModelMapper implements ViewModelMapperInterface
{
    public function map(Model $model): ViewModel
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