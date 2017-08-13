<?php

namespace FragSeb\Supervisor\Test\Client;

use FragSeb\Supervisor\Client\Client;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Model\DTO\State;
use FragSeb\Supervisor\Response\Response;
use FragSeb\Supervisor\Response\ResponseBuilderInterface;
use FragSeb\Supervisor\Response\ResponseInterface;
use Mockery\MockInterface;

/**
 * @covers \FragSeb\Supervisor\Client\Client
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var MockInterface|ConnectorInterface
     */
    private $connector;

    /**
     * @var MockInterface|ResponseBuilderInterface
     */
    private $builder;

    /**
     * @dataProvider apiProvider
     */
    public function testClientGetter($callNamespace, $arguments, $expected)
    {
        list($namspace, $method) = explode('.', $callNamespace);

        $this->expandConnectorMock($callNamespace, $arguments, $expected);
        $this->expandBuilderMock($method, $expected);

        /** @var ResponseInterface $response */

        $response =  call_user_func_array([$this->client, $method], $arguments);

        static::assertEquals($expected, $response->getContent());
    }

    public function apiProvider()
    {
        return [
            [
                'supervisor.getAPIVersion',
                [],
                '3.0',
            ],
            [
                'supervisor.getSupervisorVersion',
                [],
                '3.3.3',
            ],
            [
                'supervisor.getIdentification',
                [],
                '123123',
            ],
            [
                'supervisor.getState',
                [],
                [
                    'statename' => 'FATAL',
                    'statecode' => State::FATAL,
                ],
            ],
            [
                'supervisor.getPID',
                [],
                [
                    123,
                ],
            ],
            [
                'supervisor.readLog',
                [0, 100],
                [
                    '2017-08-11 09:11:20,470 INFO reopening log file 2017-08-11 09:15:20,441 INFO spawned: \'customer_batc"',
                ],
            ],
            [
                'supervisor.clearLog',
                [],
                true,
            ],
            [
                'supervisor.shutdown',
                [],
                true,
            ],
            [
                'supervisor.restart',
                [],
                true,
            ],
            [
                'supervisor.reloadConfig',
                [],
                [],
            ],
            [
                'supervisor.getAllProcessInfo',
                [],
                [
                    [
                        'description' => 'Exited too quickly (process log may have details)',
                        'pid' => 0,
                        'stderr_logfile' => '/var/test/customer_batch_send-7-stderr---supervisor-0kWqf6.log',
                        'stop' => 1502263849,
                        'logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                        'exitstatus' => 0,
                        'spawnerr' => 'Exited too quickly (process log may have details)',
                        'now' => 1502349416,
                        'group' => 'test-process',
                        'name' => 'test-7',
                        'statename' => 'FATAL',
                        'start' => 1502263848,
                        'state' => 200,
                        'stdout_logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                    ]
                ],
            ],
            [
                'supervisor.clearAllProcessLogs',
                [],
                [],
            ],
            [
                'supervisor.addProcessGroup',
                ['foo'],
                true,
            ],
            [
                'supervisor.removeProcessGroup',
                ['foo'],
                true,
            ],
            [
                'supervisor.clearProcessLogs',
                ['foo'],
                true,
            ],
            [
                'supervisor.clearProcessLogs',
                ['foo'],
                true,
            ],
            [
                'supervisor.startAllProcesses',
                [true],
                true,
            ],
            [
                'supervisor.stopAllProcesses',
                [true],
                true,
            ],
            [
                'supervisor.startProcess',
                ['foo', true],
                true,
            ],
            [
                'supervisor.startProcess',
                ['foo', true],
                true,
            ],
            [
                'supervisor.startProcessGroup',
                ['foo:', true],
                true,
            ],
            [
                'supervisor.stopProcess',
                ['foo', true],
                true,
            ],
            [
                'supervisor.stopProcessGroup',
                ['foo:', true],
                true,
            ],
            [
                'supervisor.sendRemoteCommEvent',
                ['test', 'utf-8'],
                true,
            ],
            [
                'supervisor.sendRemoteCommEvent',
                ['test', '{sendRemoteCommEvent}'],
                true,
            ],
            [
                'supervisor.sendProcessStdin',
                ['foo:foo', 'utf-8'],
                true,
            ],
            [
                'supervisor.readProcessStdoutLog',
                ['foo', 0, 16],
                '[2017-06-03] sdf',
            ],
            [
                'supervisor.readProcessStdoutLog',
                ['foo', 0, 16],
                '[2017-06-03] sdf',
            ],
            [
                'supervisor.readProcessStderrLog',
                ['foo', 0, 16],
                '[2017-06-03] sdf',
            ],
            [
                'supervisor.tailProcessStdoutLog',
                ['foo', 0, 16],
                [
                    '[2017-06-03] sdf',
                    false
                ],
            ],
            [
                'supervisor.tailProcessStderrLog',
                ['foo', 0, 16],
                [
                    '[2017-06-03] sdf',
                    false
                ],
            ],
            [
                'system.listMethods',
                [],
                [
                    "supervisor.addProcessGroup",
                    "supervisor.clearAllProcessLogs",
                    "supervisor.clearLog",
                    "supervisor.clearProcessLog",
                    "supervisor.clearProcessLogs",
                    "supervisor.getAPIVersion",
                    "supervisor.getAllConfigInfo",
                    "supervisor.getAllProcessInfo",
                    "supervisor.getIdentification",
                    "supervisor.getPID",
                    "supervisor.getProcessInfo",
                    "supervisor.getState",
                    "supervisor.getSupervisorVersion",
                    "supervisor.getVersion",
                    "supervisor.readLog",
                    "supervisor.readMainLog",
                    "supervisor.readProcessLog",
                    "supervisor.readProcessStderrLog",
                    "supervisor.readProcessStdoutLog",
                    "supervisor.reloadConfig",
                    "supervisor.removeProcessGroup",
                    "supervisor.restart",
                    "supervisor.sendProcessStdin",
                    "supervisor.sendRemoteCommEvent",
                    "supervisor.shutdown",
                    "supervisor.signalAllProcesses",
                    "supervisor.signalProcess",
                    "supervisor.signalProcessGroup",
                    "supervisor.startAllProcesses",
                    "supervisor.startProcess",
                    "supervisor.startProcessGroup",
                    "supervisor.stopAllProcesses",
                    "supervisor.stopProcess",
                    "supervisor.stopProcessGroup",
                    "supervisor.tailProcessLog",
                    "supervisor.tailProcessStderrLog",
                    "supervisor.tailProcessStdoutLog",
                    "system.listMethods",
                    "system.methodHelp",
                    "system.methodSignature",
                    "system.multicall",
                ],
            ],
            [
                'supervisor.getProcessInfo',
                ['rabbit'],
                [
                    'description' => 'Exited too quickly (process log may have details)',
                    'pid' => 0,
                    'stderr_logfile' => '/var/test/customer_batch_send-7-stderr---supervisor-0kWqf6.log',
                    'stop' => 1502263849,
                    'logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                    'exitstatus' => 0,
                    'spawnerr' => 'Exited too quickly (process log may have details)',
                    'now' => 1502349416,
                    'group' => 'test-process',
                    'name' => 'test-7',
                    'statename' => 'FATAL',
                    'start' => 1502263848,
                    'state' => 200,
                    'stdout_logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                ],
            ],
            [
                'supervisor.getAllConfigInfo',
                [],
                [
                    [
                        'group' =>  "consumer-customer_batch_send",
                        'name' => "customer_batch_send-3",
                        'inuse' => true,
                        'autostart' => true,
                        'process_prio' => 999,
                        'group_prio' => 999,
                    ],
                ],
            ],
            [
                'system.methodHelp',
                ['supervisor.clearAllProcessLogs'],
                [
                    "Clear all process log files\n\n@return array result   An array of process status info structs\n",
                ],
            ],
            [
                'system.methodSignature',
                ['supervisor.clearAllProcessLogs'],
                [
                    [
                        'array'
                    ],
                ],
            ],
            [
                'system.multicall',
                [
                    [
                        ['methodName' => sprintf('%s.%s', Client::RPC_NAMESPACE, 'getAllConfigInfo'), 'params' => []],
                        ['methodName' => sprintf('%s.%s', Client::RPC_NAMESPACE, 'getAllConfigInfo'), 'params' => []],
                    ]
                ],
                [],
            ],
        ];
    }

    protected function setUp()
    {
        $this->connector = \Mockery::mock(ConnectorInterface::class);
        $this->builder = \Mockery::mock(ResponseBuilderInterface::class);

        $this->client = new Client($this->connector, $this->builder);
    }

    private function expandConnectorMock($callNamespace, $arguments, $return)
    {
        $foo = true;
        $this
            ->connector
            ->shouldReceive('call')
            ->withArgs([$callNamespace, $arguments])
            ->andReturn($return)
        ;
    }

    private function expandBuilderMock($method, $content)
    {
        $this
            ->builder
            ->shouldReceive('build')
            ->withArgs([$method, $content])
            ->andReturn(new Response($method, $content))
        ;
    }
}
