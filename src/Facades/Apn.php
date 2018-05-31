<?php namespace Kiriunin\LaravelApnPush\Facades;

use Illuminate\Support\Facades\Facade;

class Apn extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'apple-apn';
    }
}