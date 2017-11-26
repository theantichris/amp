<?php

namespace AMP\Map;

use AMP\Domain\BaseModel;
use AMP\ViewModel\ViewModel;

interface ListViewModelMapperInterface
{
    public function map(BaseModel $model): ViewModel;
}