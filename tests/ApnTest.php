<?php

namespace Kiriunin\LaravelApnPush\Tests;

use Apple\ApnPush\Model\DeviceToken;
use Apple\ApnPush\Model\Notification;
use Apple\ApnPush\Model\Receiver;
use Apple\ApnPush\Sender\SenderInterface;
use Kiriunin\LaravelApnPush\Apn;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ApnTest extends TestCase
{
    /**
     * @var SenderInterface|MockObject
     */
    private $sender;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->sender = $this->createMock(SenderInterface::class);
    }

    /**
     * @test
     */
    public function shouldSuccessWithSandbox(): void
    {
        $apn = new Apn($this->sender, 'some.bundle.id', true);

        $deviceToken = str_repeat('a', 64);
        $notification = $this->createMock(Notification::class);

        $this->sender->expects(self::once())
            ->method('send')
            ->with(
                new Receiver(new DeviceToken($deviceToken), 'some.bundle.id'),
                $notification,
                true
            );

        $apn->send($deviceToken, $notification);
    }

    /**
     * @test
     */
    public function shouldSuccessWithoutSandbox(): void
    {
        $apn = new Apn($this->sender, 'topic-id', false);

        $deviceToken = str_repeat('b', 64);
        $notification = $this->createMock(Notification::class);

        $this->sender->expects(self::once())
            ->method('send')
            ->with(
                new Receiver(new DeviceToken($deviceToken), 'topic-id'),
                $notification,
                false
            );

        $apn->send($deviceToken, $notification);
    }
}
