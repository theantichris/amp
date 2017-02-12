<?php

namespace AMP\Map;

use Illuminate\Database\Eloquent\Model;
use AMP\ViewModel\ViewModel;

interface ViewModelMapperInterface
{
    public function map(Model $model): ViewModel;
}