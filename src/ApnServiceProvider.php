<?php

namespace Kiriunin\LaravelApnPush;

use Illuminate\Support\ServiceProvider;
use Kiriunin\LaravelApnPush\Registry\ApnRegistry;
use Kiriunin\LaravelApnPush\Registry\ApnRegistryFactory;
use Psr\Container\ContainerInterface;

/**
 * The provider for provide the APN config services.
 */
class ApnServiceProvider extends ServiceProvider
{
    /**
     * Register provider
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath(), 'apn-push');

        $this->app->bind(ApnRegistry::class, function () {
            $factory = new ApnRegistryFactory(new ApnFactory());

            return $factory->create(config('apn-push'));
        });

        $this->app->bind(Apn::class, function (ContainerInterface $app) {
            $config = config('apn-push');
            $defaultApn = $config['default_apn'];

            return $app->get(ApnRegistry::class)->get($defaultApn);
        });
    }

    /**
     * Boot provider
     */
    public function boot(): void
    {
        $this->publishes([$this->configPath() => config_path('apn-push.php')]);
    }

    /**
     * Get the configuration path
     *
     * @return string
     */
    protected function configPath(): string
    {
        return __DIR__ . '/../config/apn-push.php';
    }
}
