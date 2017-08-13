<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Model\DTO\ModelBuilder;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;

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
    public function getAPIVersion()
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
    public function getSupervisorVersion()
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
    public function getIdentification()
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
    public function getState()
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
    public function getPID()
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
    public function readLog($offset, $length = 0)
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
    public function clearLog()
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
    public function shutdown()
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
    public function restart()
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
    public function reloadConfig()
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
    public function getProcessInfo(string $processName)
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
    public function getAllProcessInfo()
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
    public function startAllProcesses($wait = true)
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
    public function startProcess($processName, $wait = true)
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
    public function startProcessGroup($groupName, $wait = true)
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
    public function stopAllProcesses($wait = true)
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
    public function stopProcess($processName, $wait = true)
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
    public function stopProcessGroup($groupName, $wait = true)
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
    public function sendProcessStdin($processName, $chars = 'utf-8')
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
    public function sendRemoteCommEvent($eventType, $eventData)
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
    public function addProcessGroup($processName)
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
    public function removeProcessGroup($processName)
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
    public function readProcessStdoutLog($processName, $offset, $length)
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
    public function readProcessStderrLog($processName, $offset, $length)
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
    public function tailProcessStdoutLog($processName, $offset, $length)
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
    public function tailProcessStderrLog($processName, $offset, $length)
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
    public function clearProcessLogs($processName)
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
    public function clearAllProcessLogs()
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
    public function listMethods()
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
    public function methodHelp($methodName)
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
    public function methodSignature($methodSignature)
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
    public function multicall(array $calls)
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
    public function getAllConfigInfo()
    {
        $response = $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );

        return $this->builder->build(__FUNCTION__, $response);
    }
}
