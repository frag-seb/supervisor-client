<?php

namespace FragSeb\Supervisor\Registry;

use FragSeb\Supervisor\Exception\ServerInvalidArgumentException;
use FragSeb\Supervisor\Model\Server;

interface ServerRegistryInterface
{
    /**
     * @param mixed $identifier
     *
     * @return Server
     *
     * @throws ServerInvalidArgumentException
     */
    public function get($identifier): Server;

    /**
     * @return array|Server[]
     */
    public function getAll(): array;
}
