<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;

interface ManagerInterface
{
    /**
     * @param mixed $identifier
     *
     * @return ClientInterface
     */
    public function getClient($identifier): ClientInterface;
}
