<?php

namespace FragSeb\Supervisor\Test\Client;

use FragSeb\Supervisor\Client\Client;
use FragSeb\Supervisor\Client\ClientRegistry;
use FragSeb\Supervisor\Client\ClientRegistryInterface;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Factory\ClientFactory;
use FragSeb\Supervisor\Factory\ConnectorFactoryInterface;
use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Response\ResponseBuilder;

/**
 * @covers \FragSeb\Supervisor\Client\ClientRegistry
 */
class ClientRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClientRegistryInterface
     */
    private $registry;

    public function setUp()
    {
        $config = [
            'foo' => [
                'host' => 'http://127.0.0.1:9001/RPC2',
                'auth' => [
                    'username' => 'user',
                    'password' => 123,
                ],
            ],
            'bar' => [
                'host' => 'http://127.0.0.1:9001/RPC2',
                'auth' => [
                    'username' => 'user',
                    'password' => 123,
                ],
            ],
        ];

        $connectorFactory = \Mockery::mock(ConnectorFactoryInterface::class)
            ->shouldReceive('create')
            ->with(\Mockery::type(Server::class))
            ->andReturn(\Mockery::mock(ConnectorInterface::class))
            ->getMock()
        ;

        $serverRegistry = new ServerRegistry($config, new ServerFactory());
        $clientFactory = new ClientFactory(new ResponseBuilder());

        $this->registry = new ClientRegistry($serverRegistry, $connectorFactory, $clientFactory);
    }

    public function testIsInstanceOf()
    {
        static::assertInstanceOf(ClientRegistryInterface::class, $this->registry);
    }

    public function testGet()
    {
        $client_1 = $this->registry->get('foo');
        static::assertInstanceOf(Client::class, $client_1);

        $client_2 = $this->registry->get('foo');
        static::assertSame($client_1, $client_2);
    }

    public function testGetAll()
    {
        $clientName_1 = 'foo';
        $clientName_2 = 'bar';

        $client_1 = $this->registry->getAll();

        static::assertArrayHasKey($clientName_1, $client_1);
        static::assertArrayHasKey($clientName_2, $client_1);

        $client_2 = $this->registry->getAll();

        static::assertSame($client_1, $client_2);
    }
}
