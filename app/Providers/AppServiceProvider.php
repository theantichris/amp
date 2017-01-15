<?php

namespace AMP\Providers;

use AMP\Http\Controllers\Customer\CustomerApiController;
use AMP\Repository\Customer\CustomerRepository;
use AMP\Repository\RepositoryInterface;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

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
        }

        $this->app->when(CustomerApiController::class)
                  ->needs(RepositoryInterface::class)
                  ->give(CustomerRepository::class);
    }
}
