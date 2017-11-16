<?php

namespace FragSeb\Supervisor;

use FragSeb\Supervisor\Client\ClientInterface;
use FragSeb\Supervisor\Exception\ClientBadResponseException;
use FragSeb\Supervisor\Registry\ClientRegistryInterface;
use FragSeb\Supervisor\Exception\ClientBadCallException;
use FragSeb\Supervisor\Response\Response;
use FragSeb\Supervisor\Response\ResponseInterface;

/**
 * @method ResponseInterface getAPIVersion()
 * @method ResponseInterface getSupervisorVersion()
 * @method ResponseInterface getIdentification()
 * @method ResponseInterface getState()
 * @method ResponseInterface getPID()
 * @method ResponseInterface readLog(int $offset, int $length = 0)
 * @method ResponseInterface clearLog()
 * @method ResponseInterface shutdown()
 * @method ResponseInterface restart()
 * @method ResponseInterface reloadConfig()
 * @method ResponseInterface getProcessInfo(string $processName)
 * @method ResponseInterface getAllProcessInfo()
 * @method ResponseInterface startAllProcesses(bool $wait = true)
 * @method ResponseInterface startProcess(string $processName, bool $wait = true)
 * @method ResponseInterface startProcessGroup(string $groupName, bool $wait = true)
 * @method ResponseInterface stopAllProcesses(bool $wait = true)
 * @method ResponseInterface stopProcess(string $processName, bool $wait = true)
 * @method ResponseInterface restartProcess(string $processName, bool $wait = true)
 * @method ResponseInterface stopProcessGroup(string $groupName, bool $wait = true)
 * @method ResponseInterface sendProcessStdin(string $processName, string $chars = 'utf-8')
 * @method ResponseInterface sendRemoteCommEvent(string $eventType, string $eventData)
 * @method ResponseInterface addProcessGroup(string $processName)
 * @method ResponseInterface removeProcessGroup(string $processName)
 * @method ResponseInterface readProcessStdoutLog(string $processName, int $offset, int $length)
 * @method ResponseInterface readProcessStderrLog(string $processName, int $offset, int $length)
 * @method ResponseInterface tailProcessStdoutLog(string $processName, int $offset, int $length)
 * @method ResponseInterface tailProcessStderrLog(string $processName, int $offset, int $length)
 * @method ResponseInterface clearProcessLogs(string $processName)
 * @method ResponseInterface clearAllProcessLogs()
 * @method ResponseInterface listMethods()
 * @method ResponseInterface methodHelp(string $methodName)
 * @method ResponseInterface methodSignature(string $methodSignature)
 * @method ResponseInterface multicall(array $calls)
 * @method ResponseInterface getAllConfigInfo()
 */
class ClientManager implements ManagerInterface
{
    /**
     * @var ClientRegistryInterface
     */
    private $registry;

    /**
     * Constructor.
     *
     * @param ClientRegistryInterface $registry
     */
    public function __construct(ClientRegistryInterface $registry)
    {
        $this->registry = $registry;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient($identifier): ClientInterface
    {
        return $this->registry->get($identifier);
    }

    /**
     * {@inheritdoc}
     */
    public function __call(string $method, $args): ResponseInterface
    {
        $processes = [];
        foreach ($this->registry->getAll() as $identifier => $client) {
            if (!method_exists($client, $method)) {
                throw new ClientBadCallException('The given method does not exist.');
            }

            try {
                $response = call_user_func_array([$client, $method], $args);
            } catch (\Throwable $throwable) {
                throw new ClientBadResponseException(
                    'The response form client is not allowed.',
                    $throwable->getCode(),
                    $throwable
                );
            }

            $processes[$identifier] = $response->getContent();
        }

        return new Response($method, $processes);
    }
}
