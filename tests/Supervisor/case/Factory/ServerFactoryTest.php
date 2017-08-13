<?php

namespace FragSeb\Supervisor\Test\Factory;

use FragSeb\Supervisor\Factory\ServerFactory;
use FragSeb\Supervisor\Factory\ServerFactoryInterface;
use FragSeb\Supervisor\Model\Server;

/**
 * @covers \FragSeb\Supervisor\Factory\ServerFactory
 */
class ServerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServerFactoryInterface
     */
    private $factory;

    protected function setUp()
    {
        $this->factory = new ServerFactory();
    }

    public function testValidCreate()
    {
        $identifier = 'master';
        $config = [
            'name' => 'foo bar baz',
            'host' => 'http://foo/',
            'auth' => [
                'username' => 'user',
                'password' => 123,
            ],
        ];

        $server = $this->factory->create($identifier, $config);

        static::assertInstanceOf(Server::class, $server);

        static::assertSame($identifier, $server->getIdentifier());
        static::assertSame($config['name'], $server->getName());
        static::assertSame($config['host'], $server->getHost());
        static::assertSame($config['auth']['username'], $server->getUsername());
        static::assertSame($config['auth']['password'], $server->getPassword());
    }

    /**
     * @dataProvider configServers
     */
    public function testCreate($identifier, $config, $expected)
    {
        $server = $this->factory->create($identifier, $config);

        static::assertInstanceOf(Server::class, $server);

        static::assertSame($expected['identifier'], $server->getIdentifier());
        static::assertSame($expected['name'], $server->getName());
        static::assertSame($expected['host'], $server->getHost());
        static::assertSame($expected['username'], $server->getUsername());
        static::assertSame($expected['password'], $server->getPassword());
    }

    public function configServers()
    {
        return [
            [
                'identifier' => 'master',
                'config' => [
                    'name' => 'foo bar baz',
                    'host' => 'http://foo/',
                    'auth' => [
                        'username' => 'user',
                        'password' => 123,
                    ],
                ],
                'expected' => [
                    'identifier' => 'master',
                    'name' => 'foo bar baz',
                    'host' => 'http://foo/',
                    'username' => 'user',
                    'password' => 123,
                ],
            ],
            [
                'identifier' => 'master',
                'config' => [
                    'auth' => [
                        'username' => 'user',
                        'password' => 123,
                    ],
                ],
                'expected' => [
                    'identifier' => 'master',
                    'name' => 'master',
                    'host' => Server::DEFAULT_HOST,
                    'username' => 'user',
                    'password' => 123,
                ],
            ],
            [
                'identifier' => 'master',
                'config' => [],
                'expected' => [
                    'identifier' => 'master',
                    'name' => 'master',
                    'host' => Server::DEFAULT_HOST,
                    'username' => null,
                    'password' => null,
                ],
            ],
        ];
    }
}
