<?php

namespace AMP;

use AMP\Domain\Customer\Customer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}
