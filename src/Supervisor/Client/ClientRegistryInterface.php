<?php

namespace FragSeb\Supervisor\Client;

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
