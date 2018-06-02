<?php

namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Sender\Builder\Http20Builder;
use Kiriunin\LaravelApnPush\AuthenticatorFactory\AuthenticatorFactory;
use Kiriunin\LaravelApnPush\AuthenticatorFactory\AuthenticatorFactoryInterface;
use Kiriunin\LaravelApnPush\Exception\CannotCreateAuthenticatorException;

/**
 * The factory for create the APN.
 */
class ApnFactory
{
    /**
     * @var AuthenticatorFactoryInterface
     */
    private $authenticatorFactory;

    /**
     * Constructor.
     *
     * @param AuthenticatorFactoryInterface $authenticatorFactory
     */
    public function __construct(AuthenticatorFactoryInterface $authenticatorFactory = null)
    {
        $this->authenticatorFactory = $authenticatorFactory ?: AuthenticatorFactory::createDefault();
    }

    /**
     * Create the APN by you configuration.
     *
     * @param array $config
     *
     * @return Apn
     *
     * @throws CannotCreateAuthenticatorException
     */
    public function create(array $config): Apn
    {
        $authenticator = $this->authenticatorFactory->create($config);
        $builder = new Http20Builder($authenticator);
        $sender = $builder->build();

        return new Apn($sender, $config['bundle_id'], $config['sandbox']);
    }
}
