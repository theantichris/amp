<?php

namespace AMP\Providers;

use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Service\Customer\EloquentCustomerService;
use AMP\Service\MachineProfile\EloquentMachineProfileService;
use AMP\Service\MachineProfile\MachineProfileServiceInterface;
use AMP\Service\Project\EloquentProjectService;
use AMP\Service\Project\Material\EloquentMaterialService;
use AMP\Service\Project\Material\MaterialServiceInterface;
use AMP\Service\Project\ProjectServiceInterface;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Tinker\TinkerServiceProvider;

/**
 * @codeCoverageIgnore
 */
class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
            $this->app->register(TinkerServiceProvider::class);
        }

        // Customers

        $this->app->bind(CustomerServiceInterface::class, EloquentCustomerService::class);

        // Materials

        $this->app->bind(MaterialServiceInterface::class, EloquentMaterialService::class);

        // MachineProfiles

        $this->app->bind(MachineProfileServiceInterface::class, EloquentMachineProfileService::class);

        // Projects

        $this->app->bind(ProjectServiceInterface::class, EloquentProjectService::class);
    }
}
