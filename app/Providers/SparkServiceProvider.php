<?php

namespace AMP\Providers;

use AMP\Team;
use AMP\User;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;
use Laravel\Spark\Spark;

/**
 * Class SparkServiceProvider
 *
 * @package AMP\Providers
 */
class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor'   => 'Additerra, Inc.',
        'product'  => 'Additerra Manufacturing Platform',
        'street'   => '10629 Hardin Valley Rd #210',
        'location' => 'Knoxville, TN 37932',
        'phone'    => '(865) 321-9199',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        'chrislamm@additerra.com',
        'mattserkland@additerra.com',
        'willsames@additerra.com',
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
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
