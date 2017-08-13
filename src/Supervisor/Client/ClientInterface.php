<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Response\ResponseInterface;

interface ClientInterface
{
    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getAPIVersion
     *
     * @return string
     */
    public function getAPIVersion();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getSupervisorVersion
     *
     * @return string
     */
    public function getSupervisorVersion();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getIdentification
     *
     * @return string
     */
    public function getIdentification();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getState
     *
     * @return array
     */
    public function getState();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getPID
     *
     * @return ResponseInterface|ResponseInterface[]
     */
    public function getPID();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readLog
     *
     * @param int $offset
     * @param int $length
     *
     * @return string
     */
    public function readLog($offset, $length = 0);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearLog
     *
     * @return bool
     */
    public function clearLog();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.shutdown
     *
     * @return bool
     */
    public function shutdown();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.restart
     *
     * @return bool
     */
    public function restart();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.reloadConfig
     *
     * @return array
     */
    public function reloadConfig();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getProcessInfo
     *
     * @param $processName
     *
     * @return array
     */
    public function getProcessInfo(string $processName);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getAllProcessInfo
     *
     * @return array
     */
    public function getAllProcessInfo();

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startAllProcesses
     *
     * @param bool $wait
     *
     * @return bool|array
     */
    public function startAllProcesses($wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startProcess
     *
     * @param string $processName
     * @param bool   $wait
     *
     * @return bool
     */
    public function startProcess($processName, $wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startProcessGroup
     *
     * @param string $groupName
     * @param bool   $wait
     *
     * @return bool
     */
    public function startProcessGroup($groupName, $wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopAllProcesses
     *
     * @param bool $wait
     *
     * @return bool
     */
    public function stopAllProcesses($wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopProcess
     *
     * @param string $processName
     * @param bool   $wait
     *
     * @return bool
     */
    public function stopProcess($processName, $wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopProcessGroup
     *
     * @param string $groupName
     * @param bool   $wait
     *
     * @return array
     */
    public function stopProcessGroup($groupName, $wait = true);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.sendProcessStdin
     *
     * @param string $processName
     * @param string $chars
     *
     * @return bool
     */
    public function sendProcessStdin($processName, $chars = 'utf-8');

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.sendRemoteCommEvent
     *
     * @param string $eventType
     * @param string $eventData
     *
     * @return bool
     */
    public function sendRemoteCommEvent($eventType, $eventData);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.addProcessGroup
     *
     * @param string $processName
     *
     * @return bool
     */
    public function addProcessGroup($processName);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.removeProcessGroup
     *
     * @param string $processName
     *
     * @return bool
     */
    public function removeProcessGroup($processName);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readProcessStdoutLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public function readProcessStdoutLog($processName, $offset, $length);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readProcessStderrLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return string
     */
    public function readProcessStderrLog($processName, $offset, $length);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.tailProcessStdoutLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return mixed
     */
    public function tailProcessStdoutLog($processName, $offset, $length);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.tailProcessStderrLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return array
     */
    public function tailProcessStderrLog($processName, $offset, $length);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearProcessLogs
     *
     * @param string $processName
     *
     * @return bool
     */
    public function clearProcessLogs($processName);

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearAllProcessLogs
     *
     * @return array
     */
    public function clearAllProcessLogs();

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.listMethods
     *
     * @return array
     */
    public function listMethods();

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.methodHelp
     *
     * @param $methodName
     *
     * @return string
     */
    public function methodHelp($methodName);

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.methodSignature
     *
     * @param $methodSignature
     *
     * @return array
     */
    public function methodSignature($methodSignature);

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.multicall
     *
     * @param array $calls
     *
     * @return array
     */
    public function multicall(array $calls);

    /**
     * @return array
     */
    public function getAllConfigInfo();
}
