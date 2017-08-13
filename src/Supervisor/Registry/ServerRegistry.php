<?php

namespace FragSeb\Supervisor\Registry;

use FragSeb\Supervisor\Factory\ServerFactoryInterface;
use FragSeb\Supervisor\Model\Server;

final class ServerRegistry implements ServerRegistryInterface
{
    /**
     * @var array|Server[]
     */
    private $servers;

    /**
     * @var ServerFactoryInterface
     */
    private $factory;

    /**
     * Constructor.
     *
     * @param array                  $config
     * @param ServerFactoryInterface $factory
     */
    public function __construct(array $config, ServerFactoryInterface $factory)
    {
        $this->factory = $factory;

        foreach ($config as $identifier => $row) {
            $this->add($identifier, $row);
        }
    }

    /**
     * @param mixed $identifier
     * @param array $row
     */
    public function add($identifier, array $row)
    {
        $this->servers[$identifier] = $this->factory->create($identifier, $row);
    }

    /**
     * {@inheritdoc}
     */
    public function get($identifier): Server
    {
        if (!array_key_exists($identifier, $this->servers)) {
            throw new \RuntimeException('The server with given id does not exists.');
        }

        return $this->servers[$identifier];
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): array
    {
        return $this->servers;
    }
}
