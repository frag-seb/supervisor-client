<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Client\ClientRegistryInterface;
use FragSeb\Supervisor\Response\ResponseInterface;

class ClientManager implements ManagerInterface
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
     * @method getState
     *
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $processes = [];
        foreach ($this->registry->getAll() as $identifier => $client) {
            if (!method_exists($client, $method)) {
                throw new \RuntimeException();
            }

            $processes[$identifier][] = call_user_func_array([$client, $method], $args);
        }

        return $processes;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient($identifier): ClientInterface
    {
        return $this->registry->get($identifier);
    }
}
