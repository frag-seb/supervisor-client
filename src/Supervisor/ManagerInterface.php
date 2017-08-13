<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Response\ResponseInterface;

interface ManagerInterface
{
    /**
     * @param mixed $identifier
     *
     * @return ClientInterface
     */
    public function getClient($identifier): ClientInterface;

    /**
     * @param $method
     * @param $args
     *
     * @return ResponseInterface
     */
    public function __call(string $method, $args): ResponseInterface;
}
