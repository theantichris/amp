<?php

namespace AMP\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    protected $namespace = 'AMP\Http\Controllers';

    public function boot()
    {
        parent::boot();
    }

    public function map(Router $router)
    {
        $this->mapWebRoutes($router);
        $this->mapApiRoutes($router);
    }

    protected function mapWebRoutes(Router $router)
    {
        $router->group([
            'namespace'  => $this->namespace,
            'middleware' => ['web', 'hasTeam'],
        ], function () {
            /** @noinspection PhpIncludeInspection */
            require base_path('routes/web.php');
        });
    }

    protected function mapApiRoutes(Router $router)
    {
        $router->group([
            'namespace'  => $this->namespace,
            'middleware' => 'api',
            'prefix'     => 'api',
        ], function () {
            /** @noinspection PhpIncludeInspection */
            require base_path('routes/api.php');
        });
    }
}
