<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;

/**
 * AMP\Domain\Project\Project
 *
 * @property int                 $id
 * @property string              $name
 * @property string              $status
 * @property string              $type
 * @property string              $due_date
 * @property int                 $team_id
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AMP\Domain\Project\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends BaseModel
{
}