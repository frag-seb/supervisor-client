<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Connector\ConnectorInterface;

final class Client implements ClientInterface
{
    const RPC_NAMESPACE = 'supervisor';
    const SYSTEM_NAMESPACE = 'system';

    /**
     * @var ConnectorInterface
     */
    private $connector;

    /**
     * Constructor.
     *
     * @param ConnectorInterface $connector
     */
    public function __construct(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }

    /**
     * {@inheritdoc}
     */
    public function getAPIVersion()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getSupervisorVersion()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentification()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getPID()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function readLog($offset, $length = 0)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$offset, $length]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function clearLog()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function shutdown()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function restart()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function reloadConfig()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getProcessInfo(string $processName)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            $processName
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAllProcessInfo()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function startAllProcesses($wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            $wait
        );
    }

    /**
     * {@inheritdoc}
     */
    public function startProcess($processName, $wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $wait]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function startProcessGroup($groupName, $wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$groupName, $wait]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stopAllProcesses($wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$wait]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stopProcess($processName, $wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $wait]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stopProcessGroup($groupName, $wait = true)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$groupName, $wait]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendProcessStdin($processName, $chars = 'utf-8')
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $chars]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function sendRemoteCommEvent($eventType, $eventData)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$eventType, $eventData]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function addProcessGroup($processName)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function removeProcessGroup($processName)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function readProcessStdoutLog($processName, $offset, $length)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function readProcessStderrLog($processName, $offset, $length)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tailProcessStdoutLog($processName, $offset, $length)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function tailProcessStderrLog($processName, $offset, $length)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName, $offset, $length]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function clearProcessLogs($processName)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            [$processName]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function clearAllProcessLogs()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function listMethods()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            []
        );
    }

    /**
     * {@inheritdoc}
     */
    public function methodHelp($methodName)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$methodName]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function methodSignature($methodSignature)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$methodSignature]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function multicall(array $calls)
    {
        return $this->connector->call(
            sprintf('%s.%s', static::SYSTEM_NAMESPACE, __FUNCTION__),
            [$calls]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getAllConfigInfo()
    {
        return $this->connector->call(
            sprintf('%s.%s', static::RPC_NAMESPACE, __FUNCTION__),
            []
        );
    }
}
