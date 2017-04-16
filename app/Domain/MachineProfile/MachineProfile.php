<?php

namespace AMP\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MachineProfile extends Model
{
    // Machine type: string
    // Material: string
    // Setup fee($): float
    // Machine rate ($/hr): float
    // Material cost ($/cc): float
    // Markup (%, entering '15' will mark up the cost of part by factor of 1.15): float
    // Time calculation method
    // - Volumetric (cc/hr)
    // - Z-height (cm/hr)
    // Volumetric build rate for time estimation (cc/hr): float
    // Z-Height build rate for time estimation (cm/hr): float

    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
