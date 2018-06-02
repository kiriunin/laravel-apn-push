<?php

namespace Kiriunin\LaravelApnPush\Registry;

use Kiriunin\LaravelApnPush\Apn;
use Kiriunin\LaravelApnPush\Exception\ApnNotFoundException;

/**
 * The registry for APN services.
 */
class ApnRegistry
{
    /**
     * @var array|Apn[]
     */
    private $apns;

    /**
     * Add APN to registry
     *
     * @param string $key
     * @param Apn    $apn
     */
    public function add(string $key, Apn $apn): void
    {
        $this->apns[$key] = $apn;
    }

    /**
     * Get the APN by key
     *
     * @param string $key
     *
     * @return Apn
     *
     * @throws ApnNotFoundException
     */
    public function get(string $key): Apn
    {
        if (\array_key_exists($key, $this->apns)) {
            return $this->apns[$key];
        }

        throw new ApnNotFoundException(sprintf(
            'The APN with key "%s" was not found.',
            $key
        ));
    }
}
