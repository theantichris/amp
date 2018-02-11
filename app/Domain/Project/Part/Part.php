<?php

namespace AMP\Domain\Project\Part;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Material\Material;
use AMP\Domain\Project\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Part extends BaseModel
{
    protected $fillable = [
        'name',
        'quantity',
        'requirements',
        'description',
    ];

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}