<?php

namespace AMP\Map;

use AMP\Domain\BaseModel;
use AMP\ViewModel\ViewModel;

interface DetailViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel;
}