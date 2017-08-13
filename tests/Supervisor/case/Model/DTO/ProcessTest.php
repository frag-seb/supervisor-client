<?php

namespace FragSeb\Supervisor\Test\Model\DTO;

use FragSeb\Supervisor\Model\DTO\FactoryAwareInterface;
use FragSeb\Supervisor\Model\DTO\Process;

/**
 * @covers \FragSeb\Supervisor\Model\DTO\Process
 */
class ProcessTest extends \PHPUnit_Framework_TestCase
{
    public function testIsInstanceOf()
    {
        $config = [
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
        ];
        $processes = Process::create([$config]);

        static::assertInstanceOf(FactoryAwareInterface::class, array_shift($processes));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetter($config, $isRunning, $uptime)
    {
        $processes = Process::create([$config]);

        $process = array_shift($processes);

        static::assertEquals($config['pid'], $process->getPid());
        static::assertEquals($config['group'], $process->getGroup());
        static::assertEquals($config['name'], $process->getName());
        static::assertEquals($isRunning, $process->isRunning());
        static::assertEquals($config['statename'], $process->getStatename());
        static::assertEquals($uptime, $process->getUptime());
    }

    public function dataProvider()
    {
        return [
            [
                [
                    'description' => 'Exited too quickly (process log may have details)',
                    'pid' => 0,
                    'stderr_logfile' => '/var/test/customer_batch_send-7-stderr---supervisor-0kWqf6.log',
                    'stop' => 1501690646,
                    'logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                    'exitstatus' => 0,
                    'spawnerr' => 'Exited too quickly (process log may have details)',
                    'now' => 1501692784,
                    'group' => 'test-process',
                    'name' => 'test-7',
                    'statename' => 'FATAL',
                    'start' => 1501690646,
                    'state' => 200,
                    'stdout_logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                ],
                false,
                '+0 days',
            ],
            [
                [
                    'description' => 'pid 72207, uptime 0:00:03',
                    'pid' => 72207,
                    'stderr_logfile' => '/var/test/customer_batch_send-7-stderr---supervisor-0kWqf6.log',
                    'stop' => 0,
                    'logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                    'exitstatus' => 0,
                    'spawnerr' => 'Exited too quickly (process log may have details)',
                    'now' => 1501781303,
                    'group' => 'test-process',
                    'name' => 'test-7',
                    'statename' => 'FATAL',
                    'start' => 1501694900,
                    'state' => 200,
                    'stdout_logfile' => '/var/test/customer_batch_send-7-stdout---supervisor-oCXqsn.log',
                ],
                false,
                '+1 days',
            ],
        ];
    }
}
