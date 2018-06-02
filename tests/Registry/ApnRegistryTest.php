<?php

namespace Kiriunin\LaravelApnPush\Tests;

use Kiriunin\LaravelApnPush\Apn;
use Kiriunin\LaravelApnPush\Registry\ApnRegistry;
use PHPUnit\Framework\TestCase;

class ApnRegistryTest extends TestCase
{
    /**
     * @var ApnRegistry
     */
    private $registry;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->registry = new ApnRegistry();
    }

    /**
     * @test
     */
    public function shouldSuccessGetFromRegistry(): void
    {
        $apn = $this->createMock(Apn::class);
        $this->registry->add('some', $apn);

        $result = $this->registry->get('some');

        self::assertEquals($apn, $result);
    }

    /**
     * @test
     *
     * @expectedException \Kiriunin\LaravelApnPush\Exception\ApnNotFoundException
     * @expectedExceptionMessage The APN with key "foo-bar" was not found.
     */
    public function shouldThrowExceptionIfApnNotFound(): void
    {
        $apn = $this->createMock(Apn::class);
        $this->registry->add('some', $apn);

        $this->registry->get('foo-bar');
    }
}
