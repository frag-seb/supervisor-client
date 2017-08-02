<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Model\Server;

interface ServerRegistryInterface
{
    /**
     * @param mixed $serverId
     *
     * @return Server
     *
     * @throws \RuntimeException
     */
    public function get($serverId): Server;

    /**
     * @return array|Server[]
     */
    public function getAll(): array;
}
