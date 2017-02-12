<?php

namespace AMP\Providers;

use AMP\Team;
use AMP\User;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Spark;

class SparkServiceProvider extends ServiceProvider
{
    protected $details = [
        'vendor'   => 'Additerra, Inc.',
        'product'  => 'Additerra Manufacturing Platform',
        'street'   => '10629 Hardin Valley Rd #210',
        'location' => 'Knoxville, TN 37932',
        'phone'    => '(865) 321-9199',
    ];

    protected $sendSupportEmailsTo = 'support@additerra.com';

    protected $developers = [
        'chrislamm@additerra.com',
        'mattserkland@additerra.com',
        'willsames@additerra.com',
    ];

    protected $usesApi = true;

    public function booted()
    {
        Spark::useBraintree()->noCardUpFront()->teamTrialDays(10);

        Spark::freeTeamPlan()
             ->features([
                 'First',
                 'Second',
                 'Third',
             ]);

        Spark::teamPlan('Basic', 'provider-id-1')
             ->price(10)
             ->features([
                 'First',
                 'Second',
                 'Third',
             ]);
    }

    public function register()
    {
        Spark::useUserModel(User::class);
        Spark::useTeamModel(Team::class);
    }
}
