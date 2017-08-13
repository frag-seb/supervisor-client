<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Client\ClientRegistryInterface;
use FragSeb\Supervisor\Response\Response;
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
     * {@inheritdoc}
     */
    public function __call(string $method, $args): ResponseInterface
    {
        $processes = [];
        foreach ($this->registry->getAll() as $identifier => $client) {
            if (!method_exists($client, $method)) {
                throw new \RuntimeException();
            }

            $response = call_user_func_array([$client, $method], $args);

            if (!$response instanceof ResponseInterface) {
                throw new \RuntimeException();
            }

            $processes[$identifier][] = $response->getContent();
        }

        return new Response($method, $processes);
    }

    /**
     * {@inheritdoc}
     */
    public function getClient($identifier): ClientInterface
    {
        return $this->registry->get($identifier);
    }
}
