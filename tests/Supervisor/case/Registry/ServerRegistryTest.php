<?php

namespace FragSeb\Supervisor\Test\Registry;

use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Registry\ServerRegistryInterface;

/**
 * @covers \FragSeb\Supervisor\Registry\ServerRegistry
 */
class ServerRegistryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServerRegistryInterface
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

        $this->registry = new ServerRegistry($config, new ServerFactory());
    }

    public function testIsInstanceOf()
    {
        static::assertInstanceOf(ServerRegistryInterface::class, $this->registry);
    }

    public function testGet()
    {
        static::assertInstanceOf(Server::class, $this->registry->get('foo'));
    }

    /**
     * @expectedException \FragSeb\Supervisor\Exception\ServerInvalidArgumentException
     * @expectedExceptionMessage The server with given id does not exists.
     */
    public function testServerNotExists()
    {
        static::assertInstanceOf(Server::class, $this->registry->get('baz'));
    }

    public function testGetAll()
    {
        $servers = $this->registry->getAll();

        static::assertArrayHasKey('foo', $servers);
        static::assertArrayHasKey('bar', $servers);
        static::assertInstanceOf(Server::class, $servers['foo']);
    }
}
