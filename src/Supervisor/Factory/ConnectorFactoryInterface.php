<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Model\Server;

interface ConnectorFactoryInterface
{
    /**
     * @param Server $server
     *
     * @return ConnectorInterface
     */
    public function create(Server $server): ConnectorInterface;
}
