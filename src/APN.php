<?php namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Model\DeviceToken;
use Apple\ApnPush\Model\Receiver;
use Kiriunin\LaravelApnPush\Exceptions\InvalidConfiguration;

class APN
{
    /** @var Sender */
    protected $connector;

    /**
     * APN constructor.
     *
     * @throws \Apple\ApnPush\Exception\CertificateFileNotFoundException
     * @throws InvalidConfiguration
     */
    public function __construct()
    {
        $options = config('apn-push');

        $this->connector = ApnConnector::init($options);
    }

    /**
     * Send notification to receiver and close connection
     *
     * @param string $deviceToken
     * @param ApnNotification $apnNotification
     * @throws \Apple\ApnPush\Exception\SendNotification\SendNotificationException
     */
    public function send(string $deviceToken, ApnNotification $apnNotification)
    {
        $receiver = $this->createReceiver($deviceToken);
        $sandbox = config('apn-push.sandbox');
        $notification = $apnNotification->create();

        $this->connector->send($receiver, $notification, $sandbox);

        $this->connector->closeConnection();
    }

    /**
     *
     * @param string $deviceToken
     * @return Receiver
     */
    protected function createReceiver(string $deviceToken): Receiver
    {
        $topic = config('apn-push.packageId');

        return new Receiver(new DeviceToken($deviceToken), $topic);
    }
}