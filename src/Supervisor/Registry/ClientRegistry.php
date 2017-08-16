<?php

namespace FragSeb\Supervisor\Registry;

use FragSeb\Supervisor\Client\Client;
use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Factory\ClientFactoryInterface;
use FragSeb\Supervisor\Factory\ConnectorFactoryInterface;

final class ClientRegistry implements ClientRegistryInterface
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
     * @var ConnectorFactoryInterface
     */
    private $connectorFactory;

    /**
     * @var ClientFactoryInterface
     */
    private $clientFactory;

    /**
     * Constructor.
     *
     * @param ServerRegistryInterface   $servers
     * @param ConnectorFactoryInterface $connectorFactory
     * @param ClientFactoryInterface    $clientFactory
     */
    public function __construct(
        ServerRegistryInterface $servers,
        ConnectorFactoryInterface $connectorFactory,
        ClientFactoryInterface $clientFactory
    ) {
        $this->serverRegistry = $servers;
        $this->connectorFactory = $connectorFactory;
        $this->clientFactory = $clientFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function get($serverId): ClientInterface
    {
        if (empty($this->clients[$serverId])) {
            $connector = $this->connectorFactory->create($this->serverRegistry->get($serverId));
            $this->clients[$serverId] = $this->clientFactory->create($connector);
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
            $identifier = $server->getIdentifier();
            $result[$identifier] = $this->get($identifier);
        }

        return $result;
    }
}
