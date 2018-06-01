<?php namespace Kiriunin\LaravelApnPush;

use Illuminate\Notifications\Notification;
use Kiriunin\LaravelApnPush\Exceptions\CouldNotSendNotification;

class ApnChannel
{
    /** @var APN */
    protected $apn;

    public function __construct(APN $apn)
    {
        $this->apn = $apn;
    }

    /**
     * @param $notifiable
     * @param Notification $notification
     * @throws \Apple\ApnPush\Exception\SendNotification\SendNotificationException
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toApn($notifiable);

        if (is_string($message)) {
            $message = (new ApnNotification())->setBody($message);
        }

        if (!$to = $notifiable->routeNotificationFor('apn')) {
            throw CouldNotSendNotification::deviceTokenNotProvided();
        }

        $this->apn->send($to, $message);
    }
}