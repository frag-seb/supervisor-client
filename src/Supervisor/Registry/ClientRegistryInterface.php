<?php

namespace FragSeb\Supervisor\Registry;

use FragSeb\Supervisor\Client\ClientInterface;

interface ClientRegistryInterface
{
    /**
     * @param mixed $serverId
     *
     * @return ClientInterface
     */
    public function get($serverId): ClientInterface;

    /**
     * @return array|ClientInterface[]
     */
    public function getAll(): array;
}
