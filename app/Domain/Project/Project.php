<?php

namespace AMP\Domain\Project;

use AMP\Domain\BaseModel;
use AMP\Domain\Customer\Customer;
use AMP\Domain\Project\Part\Part;
use AMP\User;
use BrianFaust\Commentable\Traits\HasComments;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;

class Project extends BaseModel implements Auditable
{
    use AuditableTrait;
    use HasComments;

    protected $fillable = [
        'status',
        'name',
        'production_cost',
        'sales_price',
        'production_due_date',
        'post_production_due_date',
        'quality_control_due_date',
        'shipped_due_date',
        'delivered_due_date',
        'shipping_provider',
        'tracking_number',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parts(): HasMany
    {
        return $this->hasMany(Part::class);
    }
}