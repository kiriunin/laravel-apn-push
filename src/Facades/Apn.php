<?php

namespace Kiriunin\LaravelApnPush\Facades;

use Illuminate\Support\Facades\Facade;

class Apn extends Facade
{
    /**
     * {@inheritdoc}
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Apn';
    }
}
