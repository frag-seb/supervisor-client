<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientRegistryInterface;
use FragSeb\Supervisor\Model\DTO\Process;
use FragSeb\Supervisor\Client\Client;

class ClientManager
{
    /**
     * @var ClientRegistryInterface
     */
    private $registry;

    /**
     * Constructor.
     *
     * @param ClientRegistryInterface $registry
     */
    public function __construct(ClientRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * @return array|Process
     */
    public function getAllProcessInfo()
    {
        $processes = [];
        foreach ($this->registry->getAll() as $serverId => $client) {
            $response = $client->getAllProcessInfo();

            foreach ($response as $data) {
                $processes[$serverId][] = Process::createProcess($data);
            }
        }

        return $processes;
    }

    /**
     * @param $serverId
     *
     * @return Client
     */
    public function getClient($serverId)
    {
        return $this->registry->get($serverId);
    }
}
