<?php

namespace WoodyNaDobhar\Dingo2Generators;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use WoodyNaDobhar\Dingo2Generators\Commands\IdeHelperCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeAuthGroupsAndActionsCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeCrudControllersCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeCrudModelsCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeCrudRoutesCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeCrudTransformersCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeImageManagerCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeRestApiProjectCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeRestAuthCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeSwaggerModelsCommand;
use WoodyNaDobhar\Dingo2Generators\Commands\MakeSwaggerRootCommand;

/**
 * Class GeneratorsServiceProviders
 * @package WoodyNaDobhar\Dingo2Generators
 */
class GeneratorsServiceProviders extends ServiceProvider
{
    /**
     * Bootstrap the application services. //testing commit
     *
     * @return void
     */
    public function boot()
    {
        //publishing configs
        $this->publishes(
            [
                __DIR__ . '/../config/rest-api-generator.php' => config_path('rest-api-generator.php'),
            ]
        );

        //register generated routes
        $apiRouteFilePath = base_path(config('rest-api-generator.paths.routes'). 'api.php');
        if (!$this->app->routesAreCached() && file_exists($apiRouteFilePath)) {
            require $apiRouteFilePath;
        }

        //register generated auth routes
        $authRouteFilePath = base_path(config('rest-api-generator.paths.routes'). 'auth.php');
        if (!$this->app->routesAreCached() && file_exists($authRouteFilePath)) {
            require $authRouteFilePath;
        }

        //register generated image management routes
        $imageRouteFilePath = base_path(config('rest-api-generator.paths.routes'). 'images.php');
        if (!$this->app->routesAreCached() && file_exists($imageRouteFilePath)) {
            require $imageRouteFilePath;
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Register commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands([
            MakeCrudRoutesCommand::class,
            MakeSwaggerModelsCommand::class,
            MakeCrudModelsCommand::class,
            MakeCrudControllersCommand::class,
            MakeCrudTransformersCommand::class,
            MakeRestApiProjectCommand::class,
            MakeSwaggerRootCommand::class,
            MakeRestAuthCommand::class,
            MakeAuthGroupsAndActionsCommand::class,
            IdeHelperCommand::class,
            MakeImageManagerCommand::class,
        ]);
    }

}