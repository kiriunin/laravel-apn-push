<?php

namespace Kiriunin\LaravelApnPush\Registry;

use Kiriunin\LaravelApnPush\ApnFactory;
use Kiriunin\LaravelApnPush\Exception\CannotCreateAuthenticatorException;

/**
 * The factory for create the registry.
 */
class ApnRegistryFactory
{
    /**
     * @var ApnFactory
     */
    private $apnFactory;

    /**
     * Constructor.
     *
     * @param ApnFactory $apnFactory
     */
    public function __construct(ApnFactory $apnFactory)
    {
        $this->apnFactory = $apnFactory;
    }

    /**
     * Create the APN registry by you configuration
     *
     * @param array $config
     *
     * @return ApnRegistry
     *
     * @throws CannotCreateAuthenticatorException
     */
    public function create(array $config): ApnRegistry
    {
        $registry = new ApnRegistry();

        foreach ($config as $key => $entry) {
            $registry->add($key, $this->apnFactory->create($entry));
        }

        return $registry;
    }
}
