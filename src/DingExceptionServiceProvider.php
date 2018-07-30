<?php

namespace  Jourdon\DingException;

use Illuminate\Support\ServiceProvider;

class DingExceptionServiceProvider extends  ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/ding.php' => config_path('ding.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('DingException', function ($app) {
            return new DingExceptionNotification($app['config']['ding']);
        });
    }
    public function provides()
    {
        return ['DingException'];
    }
}