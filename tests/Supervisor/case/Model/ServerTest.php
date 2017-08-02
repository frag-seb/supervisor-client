<?php

namespace FragSeb\Supervisor\Test\Model;

use FragSeb\Supervisor\Model\Server;

/**
 * @covers \FragSeb\Supervisor\Model\Server
 */
class ServerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var \stdClass
     */
    private $config;

    protected function setUp()
    {
        $this->config = new \stdClass();
        $this->config->serverId = 'master';
        $this->config->host = 'http://127.0.0.1:9001/RPC2';
        $this->config->auth = [
            'username' => 'tester',
            'password' => 'test',
        ];

        $this->server = new Server($this->config->serverId, $this->config->host, $this->config->auth);
    }

    public function testGetId()
    {
        static::assertEquals($this->config->serverId, $this->server->getId());
    }

    public function testGetHost()
    {
        static::assertEquals($this->config->host, $this->server->getHost());
    }

    public function testGetUsername()
    {
        static::assertEquals($this->config->auth['username'], $this->server->getUsername());
    }

    public function testGetPassword()
    {
        static::assertEquals($this->config->auth['password'], $this->server->getPassword());
    }

    /**
     * @expectedException \Throwable
     */
    public function testGetUsernameWithoutAuthConfig()
    {
        $server = new Server($this->config->serverId, $this->config->host, []);

        static::assertNull($server->getUsername());
    }

    /**
     * @expectedException \Throwable
     */
    public function testGetPasswordWithoutAuthConfig()
    {
        $server = new Server($this->config->serverId, $this->config->host, []);

        static::assertNull($server->getPassword());
    }
}
