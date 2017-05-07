<?php

namespace AMP\Domain;

use AMP\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getCreatedAt(): Carbon
    {
        return $this->attributes['created_at'];
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->attributes['updated_at'];
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->attributes['deleted_at'];
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getTeamId(): int
    {
        return $this->attributes['team_id'];
    }
}