<?php

namespace AMP\Providers;

use AMP\Http\Controllers\Customer\CustomerApiController;
use AMP\Map\Customer\CustomerListViewModelMapper;
use AMP\Map\ViewModelMapperInterface;
use AMP\Repository\Customer\CustomerRepository;
use AMP\Repository\RepositoryInterface;
use AMP\Service\Customer\CustomerService;
use AMP\Service\Customer\CustomerServiceInterface;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;

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
        }

        $this->app->when(CustomerApiController::class)
                  ->needs(CustomerServiceInterface::class)
                  ->give(CustomerService::class);

        $this->app->when(CustomerService::class)
                  ->needs(RepositoryInterface::class)
                  ->give(CustomerRepository::class);

        $this->app->when(CustomerService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(CustomerListViewModelMapper::class);
    }
}
