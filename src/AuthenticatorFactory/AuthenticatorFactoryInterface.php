<?php

namespace Kiriunin\LaravelApnPush\AuthenticatorFactory;

use Apple\ApnPush\Protocol\Http\Authenticator\AuthenticatorInterface;
use Kiriunin\LaravelApnPush\Exception\CannotCreateAuthenticatorException;

/**
 * All authenticators should implement this interface.
 */
interface AuthenticatorFactoryInterface
{
    /**
     * Is the configuration supports for create authenticator?
     *
     * @param array $config
     *
     * @return bool
     */
    public function supports(array $config): bool;

    /**
     * Create the authenticator by configuration.
     *
     * @param array $config
     *
     * @return AuthenticatorInterface
     *
     * @throws CannotCreateAuthenticatorException
     */
    public function create(array $config): AuthenticatorInterface;
}
