<?php

namespace AMP\Providers;

use AMP\Converter\Customer\CustomerJsonConverter;
use AMP\Converter\JsonConverterInterface;
use AMP\Converter\MachineProfile\MachineProfileJsonConverter;
use AMP\Converter\Project\MaterialJsonConverter;
use AMP\Converter\Project\ProjectJsonConverter;
use AMP\Http\Controllers\Project\Comment\CommentApiController;
use AMP\Map\Customer\CustomerListListViewModelMapperInterface;
use AMP\Map\DetailViewModelMapperInterface;
use AMP\Map\ListViewModelMapperInterface;
use AMP\Map\MachineProfile\MachineProfileListListViewModelMapperInterface;
use AMP\Map\Project\Comment\CommentListViewModelMapper;
use AMP\Map\Project\MaterialListViewModelMapper;
use AMP\Map\Project\ProjectDetailViewModelMapper;
use AMP\Map\Project\ProjectListListViewModelMapperInterface;
use AMP\Repository\Customer\CustomerRepository;
use AMP\Repository\RepositoryInterface;
use AMP\Service\Customer\CustomerService;
use AMP\Service\Customer\CustomerServiceInterface;
use AMP\Service\MachineProfile\MachineProfileService;
use AMP\Service\MachineProfile\MachineProfileServiceInterface;
use AMP\Service\Project\EloquentProjectService;
use AMP\Service\Project\Material\EloquentMaterialService;
use AMP\Service\Project\Material\MaterialServiceInterface;
use AMP\Service\Project\ProjectServiceInterface;
use AMP\Service\User\EloquentUserService;
use AMP\Service\User\UserServiceInterface;
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
                  ->needs(ListViewModelMapperInterface::class)
                  ->give(CustomerListListViewModelMapperInterface::class);

        // Materials

        $this->app->bind(MaterialServiceInterface::class, EloquentMaterialService::class);

        $this->app->when(EloquentMaterialService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(MaterialJsonConverter::class);

        $this->app->when(EloquentMaterialService::class)
                  ->needs(ListViewModelMapperInterface::class)
                  ->give(MaterialListViewModelMapper::class);

        // MachineProfiles

        $this->app->bind(MachineProfileServiceInterface::class, MachineProfileService::class);

        $this->app->when(MachineProfileService::class)
                  ->needs(JsonConverterInterface::class)
                  ->give(MachineProfileJsonConverter::class);

        $this->app->when(MachineProfileService::class)
                  ->needs(ListViewModelMapperInterface::class)
                  ->give(MachineProfileListListViewModelMapperInterface::class);

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

        // Users

        $this->app->bind(UserServiceInterface::class, EloquentUserService::class);
    }
}
