<?php

namespace AMP;

use AMP\Domain\Customer;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\Team as SparkTeam;

/**
 * Class Team
 *
 * @package AMP
 */
class Team extends SparkTeam
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $dates = ['deleted_at'];

    /**
     * @return HasMany
     */
    public function customers(){
        return $this->hasMany(Customer::class);
    }
}
