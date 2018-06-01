<?php namespace Kiriunin\LaravelApnPush;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ApnServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'apn-push');

        $this->app->bind(APN::class, function ($app) {
            return new APN();
        });
    }

    public function boot()
    {
        $this->publishes([$this->configPath() => config_path('apn-push.php')]);
    }

    protected function configPath()
    {
        return __DIR__ . '/../config/apn-push.php';
    }
}