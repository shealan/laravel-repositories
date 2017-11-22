<?php

namespace WesMurray\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $root = dirname(__DIR__);
        
        if (! file_exists(config_path('repository.php'))) {
            $this->publishes([
                $root . '/config/repository.php' => config_path('repository.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('repository.repositories')) {
            $this->bindRepositoryServices();
        }
    }
    
    /**
     * Bind the application repository services 
     * into the container.
     *
     * @return void
     */
    public function bindRepositoryServices()
    {
        foreach (config('repository.repositories') as $key => $value) {
            $this->app->bindIf($key, $value);
        }    
    }
}
