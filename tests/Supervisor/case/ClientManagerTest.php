<?php

namespace FragSeb\Supervisor\Test;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Client\ClientRegistry;
use FragSeb\Supervisor\ClientManager;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Factory\ClientFactoryInterface;
use FragSeb\Supervisor\Factory\ConnectorFactoryInterface;
use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Registry\ServerRegistryInterface;
use FragSeb\Supervisor\Response\Response;
use FragSeb\Supervisor\Response\ResponseInterface;
use Mockery\MockInterface;

/**
 * @covers \FragSeb\Supervisor\ClientManager
 * @covers \FragSeb\Supervisor\ServerRegistry
 */
class ClientManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ClientManager
     */
    private $manager;

    /**
     * @var ServerRegistryInterface
     */
    private $registry;

    /**
     * @var MockInterface|ConnectorInterface
     */
    private $connector;

    /**
     * @var MockInterface|ClientInterface
     */
    private $clientMock;

    public function setUp()
    {
        $config = [
            'master' => [
                'host' => 'http://127.0.0.1:9001/RPC2',
                'auth' => [
                    'username' => 'user',
                    'password' => 123,
                ],
            ],
        ];

        $serverRegistry = new ServerRegistry($config, new ServerFactory());

        $this->connector = \Mockery::mock(ConnectorInterface::class);

        $connectorFactoryMock = \Mockery::mock(ConnectorFactoryInterface::class)
            ->shouldReceive('create')
            ->with(\Mockery::type(Server::class))
            ->andReturn($this->connector)
            ->getMock()
        ;

        $this->clientMock = \Mockery::mock(ClientInterface::class);
        $clientFactoryMock = \Mockery::mock(ClientFactoryInterface::class)
            ->shouldReceive('create')
            ->with(\Mockery::type(ConnectorInterface::class))
            ->andReturn($this->clientMock)
            ->getMock()
        ;

        $this->registry = new ClientRegistry($serverRegistry, $connectorFactoryMock, $clientFactoryMock);

        $this->manager = new ClientManager($this->registry);
    }

    public function testMagicMethodCall()
    {
        $this
            ->clientMock
            ->shouldReceive('getAPIVersion')
            ->andReturn(new Response('getAPIVersion', 3.3))
        ;

        $response = $this->manager->getAPIVersion();

        static::assertArrayHasKey('master', $response);

        $response = array_shift($response['master']);
        static::assertInstanceOf(ResponseInterface::class, $response);
        static::assertEquals(3.3, $response->getContent());
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMagicMethodCallNotExsits()
    {
        $response = $this->manager->getTest();
    }

    public function testGetClient()
    {
        static::assertInstanceOf(ClientInterface::class, $this->manager->getClient('master'));
    }

    public function expandRegistryMock()
    {
    }
}
