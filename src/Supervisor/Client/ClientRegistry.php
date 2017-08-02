<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Connector\XmlRpcConnector;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;
use FragSeb\Supervisor\ServerRegistryInterface;

class ClientRegistry implements ClientRegistryInterface
{
    /**
     * @var array|Client[]
     */
    private $clients;

    /**
     * @var ServerRegistryInterface
     */
    private $serverRegistry;

    /**
     * Constructor.
     *
     * @param ServerRegistryInterface $servers
     */
    public function __construct(ServerRegistryInterface $servers)
    {
        $this->serverRegistry = $servers;
    }

    /**
     * {@inheritdoc}
     */
    public function get($serverId): Client
    {
        if (empty($this->clients[$serverId])) {
            $connector = new XmlRpcConnector($this->serverRegistry->get($serverId), new XmlRpcSerializer());
            $this->clients[$serverId] = new Client($connector);
        }

        return $this->clients[$serverId];
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        $result = [];

        foreach ($this->serverRegistry->getAll() as $server) {
            if (empty($this->clients[$server->getId()])) {
                $this->clients[$server->getId()] = new Client(new XmlRpcConnector($server, new XmlRpcSerializer()));
            }

            $result[$server->getId()] = $this->clients[$server->getId()];
        }

        return $result;
    }
}
