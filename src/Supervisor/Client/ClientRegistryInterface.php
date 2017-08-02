<?php

namespace FragSeb\Supervisor\Client;

interface ClientRegistryInterface
{
    /**
     * @param mixed $serverId
     *
     * @return Client
     */
    public function get($serverId): Client;

    /**
     * @return array|Client[]
     */
    public function getAll(): array;
}
