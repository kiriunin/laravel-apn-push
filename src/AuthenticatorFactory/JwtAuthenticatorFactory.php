<?php

namespace Kiriunin\LaravelApnPush\AuthenticatorFactory;

use Apple\ApnPush\Exception\CertificateFileNotFoundException;
use Apple\ApnPush\Jwt\Jwt;
use Apple\ApnPush\Protocol\Http\Authenticator\AuthenticatorInterface;
use Apple\ApnPush\Protocol\Http\Authenticator\JwtAuthenticator;

/**
 * The factory for create JWT authenticator by you configuration.
 */
class JwtAuthenticatorFactory implements AuthenticatorFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(array $config): bool
    {
        return \array_key_exists('jwt', $config);
    }

    /**
     * {@inheritdoc}
     *
     * @throws CertificateFileNotFoundException
     */
    public function create(array $config): AuthenticatorInterface
    {
        $jwt = new Jwt($config['teamId'], $config['key'], $config['certificatePath']);

        return new JwtAuthenticator($jwt);
    }
}
