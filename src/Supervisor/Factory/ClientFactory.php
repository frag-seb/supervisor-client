<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Client\Client;
use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;

final class ClientFactory implements ClientFactoryInterface
{
    /**
     * @var ResponseBuilderInterface
     */
    private $responseBuilder;

    /**
     * Constructor.
     *
     * @param ResponseBuilderInterface $responseBuilder
     */
    public function __construct(ResponseBuilderInterface $responseBuilder)
    {
        $this->responseBuilder = $responseBuilder;
    }

    public function create(ConnectorInterface $connector): ClientInterface
    {
        return new Client($connector, $this->responseBuilder);
    }
}
