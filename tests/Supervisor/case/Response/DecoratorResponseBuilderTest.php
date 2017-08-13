<?php

namespace FragSeb\Supervisor\Test\Response;

use FragSeb\Supervisor\Response\DecoratorResponseBuilder;
use FragSeb\Supervisor\Response\ResponseBuilder;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;
use FragSeb\Supervisor\Response\ResponseInterface;
use FragSeb\Supervisor\Response\Services\ChainDataTransferObject;

/**
 * @covers \FragSeb\Supervisor\Response\DecoratorResponseBuilder
 * @covers \FragSeb\Supervisor\Response\ResponseBuilder
 * @covers \FragSeb\Supervisor\Response\Services\ChainDataTransferObject
 */
class DecoratorResponseBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ResponseBuilderInterface
     */
    private $builder;

    public function setUp()
    {
        $this->builder = new DecoratorResponseBuilder(new ResponseBuilder(), new ChainDataTransferObject());
    }

    public function testBuildResponse()
    {
        $response = $this->builder->build('bar', 123);

        static::assertInstanceOf(ResponseInterface::class, $response);
    }
}
