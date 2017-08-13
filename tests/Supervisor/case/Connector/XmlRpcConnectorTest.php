<?php

namespace FragSeb\Supervisor\Test\Connector;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Connector\XmlRpcConnector;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;

/**
 * @covers \FragSeb\Supervisor\Connector\XmlRpcConnector
 */
class XmlRpcConnectorTest extends \PHPUnit_Framework_TestCase
{
    public function testCall()
    {
        $resource = __DIR__. '/../../resources/test.xml';
        $server = new Server('test', 'Test', $resource, ['username' => 'foo', 'password' => 'test']);
        $connector = new XmlRpcConnector($server, new XmlRpcSerializer());

        $response = $connector->call('test', []);

        static::assertEquals('RUNNING', $response['statename']);
        static::assertEquals(1, $response['statecode']);
    }

    /**
     * @expectedException \FragSeb\Supervisor\Exception\ConnectionException
     */
    public function testCallException()
    {
        $resource = __DIR__. '/../../resources/fault.xml';
        $server = new Server('test', 'Test', $resource, ['username' => 'foo', 'password' => 'test']);
        $connector = new XmlRpcConnector($server, new XmlRpcSerializer());

        $response = $connector->call('test', []);

        static::assertEquals('RUNNING', $response['statename']);
        static::assertEquals(1, $response['statecode']);
    }
}
