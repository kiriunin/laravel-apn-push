<?php namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Jwt\Jwt;
use Apple\ApnPush\Protocol\Http\Authenticator\JwtAuthenticator;
use Apple\ApnPush\Certificate\Certificate;
use Apple\ApnPush\Protocol\Http\Authenticator\CertificateAuthenticator;
use Apple\ApnPush\Sender\Builder\Http20Builder;
use Apple\ApnPush\Sender\SenderInterface;
use Kiriunin\LaravelApnPush\Exceptions\InvalidConfiguration;

class ApnConnector
{
    /**
     * Initialize sender
     *
     * @param array $options
     * @return Sender
     * @throws \Apple\ApnPush\Exception\CertificateFileNotFoundException
     * @throws InvalidConfiguration
     */
    public static function init(array $options): SenderInterface
    {
        switch ($options['default']) {
            case 'certificate':
                return self::certificateAuth($options['connections']['certificate']);
            case 'jwt':
                return self::jwtAuth($options['connections']['jwt']);
            default:
                throw new InvalidConfiguration();
        }
    }

    /**
     * JWT auth
     *
     * @param array $options
     * @return Sender
     * @throws \Apple\ApnPush\Exception\CertificateFileNotFoundException
     */
    protected static function jwtAuth(array $options): SenderInterface
    {
        $jwt = new Jwt($options['teamId'], $options['key'], $options['certificatePath']);

        $authenticator = new JwtAuthenticator($jwt);

        $builder = new Http20Builder($authenticator);
        $protocol = $builder->buildProtocol();

        return new Sender($protocol);
    }

    /**
     * Certificate auth
     *
     * @param $options
     * @return Sender
     * @throws \Apple\ApnPush\Exception\CertificateFileNotFoundException
     */
    protected static function certificateAuth($options): SenderInterface
    {
        $certificate = new Certificate($options['certificatePath'], $options['passphrase']);
        $authenticator = new CertificateAuthenticator($certificate);

        $builder = new Http20Builder($authenticator);
        $protocol = $builder->buildProtocol();

        return new Sender($protocol);
    }
}