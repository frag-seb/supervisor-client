<?php

namespace FragSeb\Supervisor\Factory;

use FragSeb\Supervisor\ManagerInterface;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;

interface ManagerFactoryInterface
{
    /**
     * @param array                         $config
     * @param ResponseBuilderInterface|null $responseBuilder
     *
     * @return ManagerInterface
     */
    public function create(array $config, ResponseBuilderInterface $responseBuilder = null): ManagerInterface;
}
