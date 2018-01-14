<?php

namespace AMP\Providers;

use AMP\Converter\JsonConverterInterface;
use AMP\Converter\Project\MaterialJsonConverter;
use AMP\Converter\Project\ProjectJsonConverter;
use AMP\Map\DetailViewModelMapperInterface;
use AMP\Map\ListViewModelMapperInterface;
use AMP\Map\Project\MaterialListViewModelMapper;
use AMP\Map\Project\ProjectDetailViewModelMapper;
use AMP\Map\Project\ProjectListListViewModelMapperInterface;
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

        $this->app->when(EloquentMaterialService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(MaterialJsonConverter::class);

        $this->app->when(EloquentMaterialService::class)
                  ->needs(ListViewModelMapperInterface::class)
                  ->give(MaterialListViewModelMapper::class);

        // MachineProfiles

        $this->app->bind(MachineProfileServiceInterface::class, EloquentMachineProfileService::class);

        // Projects

        $this->app->bind(ProjectServiceInterface::class, EloquentProjectService::class);

        $this->app->when(EloquentProjectService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(ProjectJsonConverter::class);

        $this->app->when(EloquentProjectService::class)
                  ->needs(ListViewModelMapperInterface::class)
                  ->give(ProjectListListViewModelMapperInterface::class);

        $this->app->when(EloquentProjectService::class)
                  ->needs(DetailViewModelMapperInterface::class)
                  ->give(ProjectDetailViewModelMapper::class);
    }
}
