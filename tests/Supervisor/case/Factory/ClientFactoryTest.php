<?php

namespace FragSeb\Supervisor\Test\Factory;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Factory\ClientFactory;
use FragSeb\Supervisor\Factory\ServerFactoryInterface;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Response\ResponseBuilder;

/**
 * @covers \FragSeb\Supervisor\Factory\ClientFactory
 */
class ClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServerFactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ClientFactory(new ResponseBuilder());
    }

    public function testCreate()
    {
        $connector = \Mockery::mock(ConnectorInterface::class);
        $client = $this->factory->create($connector);

        static::assertInstanceOf(ClientInterface::class, $client);
    }
}
