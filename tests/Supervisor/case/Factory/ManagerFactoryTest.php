<?php

namespace FragSeb\Supervisor\Test\Factory;

use FragSeb\Supervisor\Factory\ManagerFactory;
use FragSeb\Supervisor\Factory\ManagerFactoryInterface;
use FragSeb\Supervisor\ManagerInterface;
use FragSeb\Supervisor\Response\DecoratorResponseBuilder;
use FragSeb\Supervisor\Response\ResponseBuilder;
use FragSeb\Supervisor\Response\Services\ChainDataTransferObject;

/**
 * @covers \FragSeb\Supervisor\Factory\ManagerFactory
 */
class ManagerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ManagerFactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ManagerFactory();
    }

    public function testCreate()
    {
        $config = [
            [
                'name' => 'foo bar baz',
                'host' => 'http://foo/',
                'auth' => [
                    'username' => 'user',
                    'password' => 123,
                ],
            ]
        ];
        $client = $this->factory->create($config);

        static::assertInstanceOf(ManagerInterface::class, $client);
    }

    public function testCreateDecorator()
    {
        $config = [
            [
                'name' => 'foo bar baz',
                'host' => 'http://foo/',
                'auth' => [
                    'username' => 'user',
                    'password' => 123,
                ],
            ]
        ];
        $chainMock = \Mockery::mock(ChainDataTransferObject::class);
        $responseBuilder = new DecoratorResponseBuilder(new ResponseBuilder(), $chainMock);
        $client = $this->factory->create($config, $responseBuilder);

        static::assertInstanceOf(ManagerInterface::class, $client);
    }
}
