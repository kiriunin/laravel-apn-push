<?php

namespace Kiriunin\LaravelApnPush\AuthenticatorFactory;

use Apple\ApnPush\Protocol\Http\Authenticator\AuthenticatorInterface;
use Kiriunin\LaravelApnPush\Exception\CannotCreateAuthenticatorException;

/**
 * Default authenticator factory.
 */
class AuthenticatorFactory implements AuthenticatorFactoryInterface
{
    /**
     * @var AuthenticatorFactoryInterface[]
     */
    private $factories;

    /**
     * Constructor.
     *
     * @param AuthenticatorFactoryInterface ...$factories
     */
    public function __construct(AuthenticatorFactoryInterface ...$factories)
    {
        $this->factories = $factories;
    }

    /**
     * Create default authenticator factory.
     *
     * @return AuthenticatorFactory
     */
    public static function createDefault(): AuthenticatorFactory
    {
        return new AuthenticatorFactory(
            new JwtAuthenticatorFactory(),
            new CertificateAuthenticatorFactory()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function supports(array $config): bool
    {
        try {
            $this->getFactoryByConfig($config);
        } catch (CannotCreateAuthenticatorException $e) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $config): AuthenticatorInterface
    {
        return $this->getFactoryByConfig($config)->create($config);
    }

    /**
     * Get the factory by configuration
     *
     * @param array $config
     *
     * @return AuthenticatorFactoryInterface
     *
     * @throws CannotCreateAuthenticatorException
     */
    private function getFactoryByConfig(array $config): AuthenticatorFactoryInterface
    {
        foreach ($this->factories as $factory) {
            if ($factory->supports($config)) {
                return $factory;
            }
        }

        throw new CannotCreateAuthenticatorException('Cannot create the authenticator by you configuration.');
    }
}
