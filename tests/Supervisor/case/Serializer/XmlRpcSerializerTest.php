<?php

namespace FragSeb\Supervisor\Test\Serializer;

use FragSeb\Supervisor\Serializer\SerializerInterface;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;

/**
 * @covers \FragSeb\Supervisor\Serializer\XmlRpcSerializer
 */
class XmlRpcSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function setUp()
    {
        $this->serializer = new XmlRpcSerializer();
    }

    public function testIsInstanceOf()
    {
        static::assertInstanceOf(SerializerInterface::class, $this->serializer);
    }

    public function testDencode()
    {
        $result = $this->serializer->dencode($this->getBody());

        static::assertArrayHasKey('statename', $result);
        static::assertArrayHasKey('statecode', $result);

        static::assertSame('RUNNING', $result['statename']);
        static::assertSame(1, $result['statecode']);
    }

    public function testEncode()
    {
        $xml = $this->serializer->encode('supervisor.getState', []);
        $request = $this->getXmlRequest();

        static::assertEquals($request, $xml);
    }

    private function getBody()
    {
        return <<<xml
<?xml version='1.0'?>
<methodResponse>
<params>
<param>
<value><struct>
<member>
<name>statename</name>
<value><string>RUNNING</string></value>
</member>
<member>
<name>statecode</name>
<value><int>1</int></value>
</member>
</struct></value>
</param>
</params>
</methodResponse>
xml;
    }

    private function getXmlRequest()
    {
        return <<<xml
<?xml version="1.0" encoding="utf-8"?>
<methodCall>
<methodName>supervisor.getState</methodName>
<params/>
</methodCall>

xml;
    }
}
