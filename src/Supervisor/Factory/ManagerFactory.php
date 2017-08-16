<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Registry\ClientRegistry;
use FragSeb\Supervisor\ClientManager;
use FragSeb\Supervisor\ManagerInterface;
use FragSeb\Supervisor\Registry\ServerRegistry;
use FragSeb\Supervisor\Response\ResponseBuilder;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;
use FragSeb\Supervisor\Serializer\XmlRpcSerializer;

final class ManagerFactory implements ManagerFactoryInterface
{
    /**
     * @param array                         $config
     * @param ResponseBuilderInterface|null $responseBuilder
     *
     * @return ManagerInterface|ClientInterface
     */
    public function create(array $config, ResponseBuilderInterface $responseBuilder = null): ManagerInterface
    {
        $responseBuilder = $responseBuilder ?? new ResponseBuilder;
        $clientRegistry = new ClientRegistry(
            new ServerRegistry($config, new ServerFactory),
            new XmlRpcConnectorFactory(new XmlRpcSerializer),
            new ClientFactory($responseBuilder)
        );

        return new ClientManager($clientRegistry);
    }
}
