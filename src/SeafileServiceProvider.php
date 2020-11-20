<?php
namespace Jiajiale\LaravelSeafile;

use Illuminate\Support\ServiceProvider;

class SeafileServiceProvider extends ServiceProvider
{
    /**
     * If is defer.
     * @var bool
     */
    protected $defer = true;

    /**
     *  Boot the service.
     */
    public function boot()
    {
        $this->publishes([
            dirname(__DIR__).'/config/seafile.php' => config_path('laravel-seafile.php'), ],
            'laravel-seafile'
        );
    }

    /**
     * Register the service.
     */
    public function register()
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/seafile.php', 'laravel.seafile');

        $this->app->singleton('laravel-seafile', function () {
            return new Seafile(config('laravel.seafile'));
        });
    }
}