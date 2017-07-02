<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends BaseModel
{
    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }
}