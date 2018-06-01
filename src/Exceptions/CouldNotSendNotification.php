<?php namespace Kiriunin\LaravelApnPush\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    public static function deviceTokenNotProvided()
    {
        return static('APN device token was not provided. Please refer usage docs.');
    }
}