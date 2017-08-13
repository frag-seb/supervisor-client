<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Connector\XmlRpcConnector;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Serializer\SerializerInterface;

final class XmlRpcConnectorFactory implements ConnectorFactoryInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * Constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function create(Server $server): ConnectorInterface
    {
        return new XmlRpcConnector($server, $this->serializer);
    }
}
