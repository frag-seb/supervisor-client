<?php

namespace FragSeb\Supervisor\Test\Response;

use FragSeb\Supervisor\Response\Response;
use FragSeb\Supervisor\Response\ResponseInterface;

/**
 * @covers \FragSeb\Supervisor\Response\Response
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function setUp()
    {
        $this->response = new Response('test', ['foo' => 'bar']);
    }

    public function testGetMethod()
    {
        static::assertEquals('test', $this->response->getMethod());
    }

    public function testGetContent()
    {
        static::assertEquals(['foo' => 'bar'], $this->response->getContent());
    }
}
