<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * AMP\Domain\Project\Part
 *
 * @property int                                                                          $id
 * @property string                                                                       $name
 * @property int|null                                                                     $quantity
 * @property string|null                                                                  $requirements
 * @property int                                                                          $project_id
 * @property int                                                                          $team_id
 * @property \Carbon\Carbon|null                                                          $deleted_at
 * @property \Carbon\Carbon|null                                                          $created_at
 * @property \Carbon\Carbon|null                                                          $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\AMP\Domain\Project\Material[] $materials
 * @property-read \AMP\Domain\Project\Project                                             $project
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Part whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Part extends BaseModel
{
    public function getQuantity(): ?int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): Part
    {
        $this->attributes['quantity'] = $quantity;

        return $this;
    }

    public function getRequirements(): ?string
    {
        return $this->attributes['requirements'];
    }

    public function setRequirements(string $requirements): Part
    {
        $this->attributes['requirements'] = $requirements;

        return $this;
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}