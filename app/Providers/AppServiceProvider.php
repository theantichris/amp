<?php

namespace AMP\Providers;

use AMP\Converter\Customer\CustomerJsonConverter;
use AMP\Converter\JsonConverterInterface;
use AMP\Converter\MachineProfile\MachineProfileJsonConverter;
use AMP\Converter\Project\MaterialJsonConverter;
use AMP\Converter\Project\PartJsonConverter;
use AMP\Converter\Project\ProjectJsonConverter;
use AMP\Map\Customer\CustomerListViewModelMapper;
use AMP\Map\MachineProfile\MachineProfileListViewModelMapper;
use AMP\Map\Project\MaterialListViewModelMapper;
use AMP\Map\Project\PartListViewModelMapper;
use AMP\Map\Project\ProjectListViewModelMapper;
use AMP\Map\ViewModelMapperInterface;
use AMP\Repository\Customer\CustomerRepository;
use AMP\Repository\RepositoryInterface;
use AMP\Service\Customer\CustomerService;
use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Service\MachineProfile\MachineProfileService;
use AMP\Service\MachineProfile\MachineProfileServiceInterface;
use AMP\Service\Project\MaterialService;
use AMP\Service\Project\MaterialServiceInterface;
use AMP\Service\Project\PartService;
use AMP\Service\Project\PartServiceInterface;
use AMP\Service\Project\ProjectService;
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

        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);

        $this->app->when(CustomerService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(CustomerJsonConverter::class);

        $this->app->when(CustomerService::class)
                  ->needs(RepositoryInterface::class)
                  ->give(CustomerRepository::class);

        $this->app->when(CustomerService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(CustomerListViewModelMapper::class);

        // Materials

        $this->app->bind(MaterialServiceInterface::class, MaterialService::class);

        $this->app->when(MaterialService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(MaterialJsonConverter::class);

        $this->app->when(MaterialService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(MaterialListViewModelMapper::class);

        // MachineProfiles

        $this->app->bind(MachineProfileServiceInterface::class, MachineProfileService::class);

        $this->app->when(MachineProfileService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(MachineProfileJsonConverter::class);

        $this->app->when(MachineProfileService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(MachineProfileListViewModelMapper::class);

        // Projects

        $this->app->when(ProjectService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(ProjectJsonConverter::class);

        $this->app->when(ProjectService::class)
                  ->needs(ViewModelMapperInterface::class)
                  ->give(ProjectListViewModelMapper::class);
    }
}
