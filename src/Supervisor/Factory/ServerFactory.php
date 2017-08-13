<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\Model\Server;

final class ServerFactory implements ServerFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create($identifier, array $data): Server
    {
        $name = $data['name'] ?? $identifier;
        $host = $data['host'] ?? Server::DEFAULT_HOST;
        $auth = $data['auth'] ?? [];

        return new Server($identifier, $name, $host, $auth);
    }
}
