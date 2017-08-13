<?php

namespace FragSeb\Supervisor\Test\Response;

use FragSeb\Supervisor\Response\ResponseBuilder;
use FragSeb\Supervisor\Response\ResponseInterface;

/**
 * @covers \FragSeb\Supervisor\Response\ResponseBuilder
 */
class ResponseBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testBuildResponse()
    {
        $builder = new ResponseBuilder();

        $response = $builder->build('bar', 123);

        static::assertInstanceOf(ResponseInterface::class, $response);
    }
}
