<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Model\Server;

interface ServerFactoryInterface
{
    /**
     * @param mixed $identifier
     * @param array $data
     *
     * @return Server
     */
    public function create($identifier, array $data): Server;
}
