<?php

namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Exception\SendNotification\SendNotificationException;
use Apple\ApnPush\Model\DeviceToken;
use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\Receiver;
use Apple\ApnPush\Sender\SenderInterface;

/**
 * The APN service
 */
class Apn
{
    /**
     * @var SenderInterface
     */
    private $sender;

    /**
     * @var string
     */
    private $bundleId;

    /**
     * @var bool
     */
    private $sandbox;

    /**
     * Constructor.
     *
     * @param SenderInterface $sender
     * @param string          $bundleId
     * @param bool            $sandbox
     */
    public function __construct(SenderInterface $sender, string $bundleId, bool $sandbox)
    {
        $this->sender = $sender;
        $this->bundleId = $bundleId;
        $this->sandbox = $sandbox;
    }

    /**
     * Send notification to receiver and close connection
     *
     * @param string       $deviceToken
     * @param Notification $notification
     *
     * @throws SendNotificationException
     */
    public function send(string $deviceToken, Notification $notification): void
    {
        $receiver = $this->createReceiver($deviceToken);

        $this->sender->send($receiver, $notification, $this->sandbox);
    }

    /**
     * Create the receiver
     *
     * @param string $deviceToken
     *
     * @return Receiver
     */
    protected function createReceiver(string $deviceToken): Receiver
    {
        return new Receiver(new DeviceToken($deviceToken), $this->bundleId);
    }
}
