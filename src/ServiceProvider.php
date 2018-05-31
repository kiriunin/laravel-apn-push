<?php namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Sender\Sender;
use Apple\ApnPush\Jwt\Jwt;
use Apple\ApnPush\Protocol\Http\Authenticator\JwtAuthenticator;
use Apple\ApnPush\Sender\Builder\Http20Builder;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->app->singleton(Sender::class, function ($app) {
            $options = $app['config']->get('apn-push');

            return $this->jwtAuth($options);
        });

        $this->app->alias(Sender::class, 'apn-push');
    }

    public function boot()
    {
        $this->publishes([$this->configPath() => config_path('apn-push.php')]);
    }

    protected function jwtAuth(array $options): Sender
    {
        $jwt = new Jwt($options['teamId'], $options['key'], $options['certificatePath']);

        $authenticator = new JwtAuthenticator($jwt);

        $builder = new Http20Builder($authenticator);
        $protocol = $builder->buildProtocol();

        return new Sender($protocol);
    }

    protected function configPath()
    {
        return __DIR__ . '/../config/apn-push.php';
    }
}