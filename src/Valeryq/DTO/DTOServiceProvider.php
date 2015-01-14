<?php namespace Valeryq\DTO;

use Illuminate\Support\ServiceProvider;


class DTOServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['dto'] = $this->app->share(function ($app) {
            return new \Service\DTO;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('dto');
    }
}
