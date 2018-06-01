<?php namespace Kiriunin\LaravelApnPush;

use Apple\ApnPush\Sender\SenderInterface;
use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\Receiver;
use Apple\ApnPush\Protocol\ProtocolInterface;

class Sender implements SenderInterface
{
    /**
     * @var ProtocolInterface
     */
    protected $protocol;

    /**
     * Constructor.
     *
     * @param ProtocolInterface $protocol
     */
    public function __construct(ProtocolInterface $protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Receiver $receiver, Notification $notification, bool $sandbox = false): void
    {
        $this->protocol->send($receiver, $notification, $sandbox);
    }

    /**
     * {@inheritdoc}
     */
    public function closeConnection()
    {
        $this->protocol->closeConnection();
    }
}