<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Exception\ClientBadCallException;
use FragSeb\Supervisor\Exception\ClientBadResponseException;
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
     *
     * @throws ClientBadCallException
     * @throws ClientBadResponseException
     */
    public function __call(string $method, $args): ResponseInterface;
}
