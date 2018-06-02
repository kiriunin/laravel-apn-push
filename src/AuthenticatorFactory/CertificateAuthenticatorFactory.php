<?php

namespace Kiriunin\LaravelApnPush\AuthenticatorFactory;

use Apple\ApnPush\Certificate\Certificate;
use Apple\ApnPush\Exception\CertificateFileNotFoundException;
use Apple\ApnPush\Protocol\Http\Authenticator\AuthenticatorInterface;
use Apple\ApnPush\Protocol\Http\Authenticator\CertificateAuthenticator;

/**
 * The factory for create the authenticator by certificate.
 */
class CertificateAuthenticatorFactory implements AuthenticatorFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports(array $config): bool
    {
        return \array_key_exists('certificate', $config);
    }

    /**
     * {@inheritdoc}
     *
     * @throws CertificateFileNotFoundException
     */
    public function create(array $config): AuthenticatorInterface
    {
        $certificate = new Certificate($config['path'], $config['passphrase']);

        return new CertificateAuthenticator($certificate);
    }
}
