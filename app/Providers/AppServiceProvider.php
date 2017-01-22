<?php

namespace AMP\Providers;

use AMP\Repository\Customer\CustomerRepository;
use AMP\Repository\RepositoryInterface;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\ServiceProvider;
use AMP\Map\Customer\CustomerListViewModelMapper;
use AMP\Map\ViewModelMapperInterface;
use AMP\Service\Customer\CustomerService;

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

        $this->app->when(CustomerService::class)
                  ->needs(RepositoryInterface::class)
                  ->give(CustomerRepository::class);

        $this->app->when(CustomerService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(CustomerListViewModelMapper::class);
    }
}
