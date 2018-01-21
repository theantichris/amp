<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\User;
use BrianFaust\Commentable\Traits\HasComments;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends BaseModel implements Auditable
{
    use AuditableTrait;
    use HasComments;

    protected $fillable = [
        'status',
        'name',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}