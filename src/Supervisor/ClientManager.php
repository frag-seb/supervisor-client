<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Exception\ClientBadResponseException;
use FragSeb\Supervisor\Registry\ClientRegistryInterface;
use FragSeb\Supervisor\Exception\ClientBadCallException;
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
    public function getClient($identifier): ClientInterface
    {
        return $this->registry->get($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function __call(string $method, $args): ResponseInterface
    {
        $processes = [];
        foreach ($this->registry->getAll() as $identifier => $client) {
            if (!method_exists($client, $method)) {
                throw new ClientBadCallException('The given method does not exist.');
            }

            try {
                $response = call_user_func_array([$client, $method], $args);
            } catch (\Throwable $throwable) {
                throw new ClientBadResponseException(
                    'The response form client is not allowed.',
                    $throwable->getCode(),
                    $throwable
                );
            }

            $processes[$identifier][] = $response->getContent();
        }

        return new Response($method, $processes);
    }
}
