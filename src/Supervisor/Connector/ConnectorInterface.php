<?php

namespace FragSeb\Supervisor\Connector;

use FragSeb\Supervisor\Exception\ConnectionException;

interface ConnectorInterface
{
    /**
     * @param       $method
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws ConnectionException
     */
    public function call($method, $arguments = []);
}
