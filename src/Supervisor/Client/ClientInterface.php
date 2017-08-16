<?php

namespace FragSeb\Supervisor\Client;

use FragSeb\Supervisor\Response\ResponseInterface;

interface ClientInterface
{
    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getAPIVersion
     *
     * @return ResponseInterface Content:string|array
     */
    public function getAPIVersion(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getSupervisorVersion
     *
     * @return ResponseInterface Content:string|array
     */
    public function getSupervisorVersion(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getIdentification
     *
     * @return ResponseInterface Content:string|array
     */
    public function getIdentification(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getState
     *
     * @return ResponseInterface Content:array
     */
    public function getState(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getPID
     *
     * @return ResponseInterface Content:int|array
     */
    public function getPID(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readLog
     *
     * @param int $offset
     * @param int $length
     *
     * @return ResponseInterface Content:string|array
     */
    public function readLog(int $offset, int $length = 0): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearLog
     *
     * @return ResponseInterface Content:bool|array
     */
    public function clearLog(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.shutdown
     *
     * @return ResponseInterface Content:bool|array
     */
    public function shutdown(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.restart
     *
     * @return ResponseInterface Content:bool|array
     */
    public function restart(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.reloadConfig
     *
     * @return ResponseInterface Content:array
     */
    public function reloadConfig(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getProcessInfo
     *
     * @param $processName
     *
     * @return ResponseInterface Content:array
     */
    public function getProcessInfo(string $processName): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.getAllProcessInfo
     *
     * @return ResponseInterface Content:array
     */
    public function getAllProcessInfo(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startAllProcesses
     *
     * @param bool $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function startAllProcesses(bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startProcess
     *
     * @param string $processName
     * @param bool   $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function startProcess(string $processName, bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.startProcessGroup
     *
     * @param int|string $groupName
     * @param bool       $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function startProcessGroup(string $groupName, bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopAllProcesses
     *
     * @param bool $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function stopAllProcesses(bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopProcess
     *
     * @param string $processName
     * @param bool   $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function stopProcess(string $processName, bool $wait = true): ResponseInterface;

    /**
     * @param string $processName
     * @param bool   $wait
     *
     * @return ResponseInterface Content:bool|array
     */
    public function restartProcess(string $processName, bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.stopProcessGroup
     *
     * @param string $groupName
     * @param bool   $wait
     *
     * @return ResponseInterface Content:array
     */
    public function stopProcessGroup(string $groupName, bool $wait = true): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.sendProcessStdin
     *
     * @param string $processName
     * @param string $chars
     *
     * @return ResponseInterface Content:bool|array
     */
    public function sendProcessStdin(string $processName, string $chars = 'utf-8'): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.sendRemoteCommEvent
     *
     * @param string $eventType
     * @param string $eventData
     *
     * @return ResponseInterface Content:bool|array
     */
    public function sendRemoteCommEvent(string $eventType, string $eventData): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.addProcessGroup
     *
     * @param string $processName
     *
     * @return ResponseInterface Content:bool|array
     */
    public function addProcessGroup(string $processName): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.removeProcessGroup
     *
     * @param string $processName
     *
     * @return ResponseInterface Content:bool|array
     */
    public function removeProcessGroup(string $processName): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readProcessStdoutLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return ResponseInterface Content:string|array
     */
    public function readProcessStdoutLog(string $processName, int $offset, int $length): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.readProcessStderrLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return ResponseInterface Content:string|array
     */
    public function readProcessStderrLog(string $processName, int $offset, int $length): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.tailProcessStdoutLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return ResponseInterface Content:mixed
     */
    public function tailProcessStdoutLog(string $processName, int $offset, int $length): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.tailProcessStderrLog
     *
     * @param string $processName
     * @param int    $offset
     * @param int    $length
     *
     * @return ResponseInterface Content:array
     */
    public function tailProcessStderrLog(string $processName, int $offset, int $length): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearProcessLogs
     *
     * @param string $processName
     *
     * @return ResponseInterface Content:bool|array
     */
    public function clearProcessLogs(string $processName): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.rpcinterface.SupervisorNamespaceRPCInterface.clearAllProcessLogs
     *
     * @return ResponseInterface Content:array
     */
    public function clearAllProcessLogs(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.listMethods
     *
     * @return ResponseInterface Content:array
     */
    public function listMethods(): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.methodHelp
     *
     * @param string $methodName
     *
     * @return ResponseInterface Content:string|array
     */
    public function methodHelp(string $methodName): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.methodSignature
     *
     * @param string $methodSignature
     *
     * @return ResponseInterface Content:array
     */
    public function methodSignature(string $methodSignature): ResponseInterface;

    /**
     * @see http://supervisord.org/api.html#supervisor.xmlrpc.SystemNamespaceRPCInterface.multicall
     *
     * @param array $calls
     *
     * @return ResponseInterface Content:array
     */
    public function multicall(array $calls): ResponseInterface;

    /**
     * @return ResponseInterface Content:array
     */
    public function getAllConfigInfo(): ResponseInterface;
}
