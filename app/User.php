<?php

namespace AMP;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\CanJoinTeams;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    use CanJoinTeams;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    protected $casts = [
        'trial_ends_at'        => 'date',
        'uses_two_factor_auth' => 'boolean',
    ];

    protected $dates = ['deleted_at'];
}
