<?php namespace Kiriunin\LaravelApnPush\Facades;

use Illuminate\Support\Facades\Facade;

class APN extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ApnService';
    }
}