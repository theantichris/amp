<?php

namespace AMP\Map;

use AMP\Domain\BaseModel;
use AMP\ViewModel\ViewModel;

interface ViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel;
}