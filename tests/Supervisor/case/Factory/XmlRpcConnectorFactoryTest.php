<?php

namespace FragSeb\Supervisor\Test\Factory;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Factory\ConnectorFactoryInterface;
use FragSeb\Supervisor\Factory\XmlRpcConnectorFactory;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Serializer\SerializerInterface;

/**
 * @covers \FragSeb\Supervisor\Factory\XmlRpcConnectorFactory
 */
class XmlRpcConnectorFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConnectorFactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $serializerMock = \Mockery::mock(SerializerInterface::class);
        $serializerMock
            ->shouldIgnoreMissing()
        ;

        $this->factory = new XmlRpcConnectorFactory($serializerMock);
    }

    public function testIsInstanceOf()
    {
        static::assertInstanceOf(ConnectorFactoryInterface::class, $this->factory);
    }

    public function testCreate()
    {
        $serverMock = \Mockery::mock(Server::class)
            ->shouldReceive([
                'getUsername' => 'foo',
                'getPassword' => 'foo',
            ])
            ->getMock()
        ;

        static::assertInstanceOf(ConnectorInterface::class, $this->factory->create($serverMock));
    }
}
