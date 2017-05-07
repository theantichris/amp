<?php

namespace AMP\Converter;

use Illuminate\Database\Eloquent\Model;

interface JsonConverterInterface
{
    public function convert(Model $model, string $json): Model;
}