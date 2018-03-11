<?php

namespace AMP\Domain\Project\Part;

use AMP\Domain\BaseModel;
use AMP\Domain\Project\Material\Material;
use AMP\Domain\Project\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Part extends BaseModel
{
    protected $fillable = [
        'name',
        'quantity',
        'requirements',
        'description',
        'urls',
    ];

    protected $casts = [
        'urls' => 'array',
    ];

    public function addUrl(string $url): Part
    {
        $urls = [];

        if (!$this->urls) {
            $this->urls = [];
        }

        foreach ($this->urls as $oldUrl) {
            $urls[] = $oldUrl;
        }

        $urls[] = $url;

        $this->urls = $urls;

        return $this;
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}