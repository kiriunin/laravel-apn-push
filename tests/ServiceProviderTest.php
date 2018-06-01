<?php namespace Tests\Kiriunin\LaravelApnPush;

use Apple\ApnPush\Sender\Sender;
use Kiriunin\LaravelApnPush\Facades\APN;

class ServiceProviderTest extends TestCase
{
    private $sender;

    protected function setUp()
    {
        $this->sender = $this->createMock(Sender::class);
    }

    public function shouldSuccessSend()
    {

    }
}