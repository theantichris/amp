<?php

namespace AMP\Map\MachineProfile;

use AMP\Domain\BaseModel;
use AMP\Domain\MachineProfile\MachineProfile;
use AMP\Map\ListViewModelMapperInterface;
use AMP\ViewModel\MachineProfile\MachineProfileListViewModel;
use AMP\ViewModel\ViewModel;

class MachineProfileListListViewModelMapperInterface implements ListViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel
    {
        /** @var MachineProfile $model */
        $viewModel = new MachineProfileListViewModel(
            $model->getId(),
            $model->getType(),
            $model->getSetupFee(),
            $model->getRate()
        );

        return $viewModel;
    }
}