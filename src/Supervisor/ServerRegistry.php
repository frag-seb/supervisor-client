<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Model\Server;

final class ServerRegistry implements ServerRegistryInterface
{
    /**
     * @var array|Server[]
     */
    private $servers;

    /**
     * Constructor.
     *
     * @param array $servers
     */
    public function __construct(array $servers)
    {
        foreach ($servers as $id => $server) {
            $this->servers[$id] = new Server($id, $server['host'], $server['auth']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function get($id): Server
    {
        if (!array_key_exists($id, $this->servers)) {
            throw new \RuntimeException('The server with given id does not exists.');
        }

        return $this->servers[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        return $this->servers;
    }
}
