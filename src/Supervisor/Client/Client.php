<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;
use FragSeb\Supervisor\Response\ResponseInterface;

final class Client implements ClientInterface
{
    const RPC_NAMESPACE = 'supervisor';
    const SYSTEM_NAMESPACE = 'system';

    /**
     * @var ConnectorInterface
     */
    private $connector;

    /**
     * @var ResponseBuilderInterface
     */
    private $builder;

    /**
     * Constructor.
     *
     * @param ConnectorInterface       $connector
     * @param ResponseBuilderInterface $builder
     */
    public function __construct(ConnectorInterface $connector, ResponseBuilderInterface $builder)
    {
        $this->connector = $connector;
        $this->builder = $builder;
    }

    /**
     * {@inheritdoc}
     */
    public function getAPIVersion(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getSupervisorVersion(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentification(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getState(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getPID(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function readLog(int $offset, int $length = 0): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$offset, $length]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function clearLog(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function shutdown(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function restart(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function reloadConfig(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getProcessInfo(string $processName): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProcessInfo(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function startAllProcesses(bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function startProcess(string $processName, bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function startProcessGroup(string $groupName, bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$groupName, $wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function stopAllProcesses(bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function stopProcess(string $processName, bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function restartProcess(string $processName, bool $wait = true): ResponseInterface
    {
        $content = [];
        $response = $this->stopProcess($processName, $wait);
        $content['stop'] = $response->getContent();
        $response = $this->startProcess($processName, $wait);
        $content['start'] = $response->getContent();

        return $this->builder->build(__FUNCTION__, $content);
    }

    /**
     * {@inheritdoc}
     */
    public function stopProcessGroup(string $groupName, bool $wait = true): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$groupName, $wait]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function sendProcessStdin(string $processName, string $chars = 'utf-8'): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $chars]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function sendRemoteCommEvent(string $eventType, string $eventData): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$eventType, $eventData]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function addProcessGroup(string $processName): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function removeProcessGroup(string $processName): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function readProcessStdoutLog(string $processName, int $offset, int $length): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function readProcessStderrLog(string $processName, int $offset, int $length): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function tailProcessStdoutLog(string $processName, int $offset, int $length): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function tailProcessStderrLog(string $processName, int $offset, int $length): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function clearProcessLogs(string $processName): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function clearAllProcessLogs(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function listMethods(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function methodHelp(string $methodName): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$methodName]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function methodSignature(string $methodSignature): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$methodSignature]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function multicall(array $calls): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$calls]
        );

        return $this->builder->build(__FUNCTION__, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllConfigInfo(): ResponseInterface
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }
}
