<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;

interface ClientFactoryInterface
{
    public function create(ConnectorInterface $connector): ClientInterface;
}
