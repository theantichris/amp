<?php

namespace AMP\Converter;

use AMP\Team;
use Illuminate\Database\Eloquent\Model;

interface JsonConverterInterface
{
    public function convert(string $json, Team $team): Model;
}