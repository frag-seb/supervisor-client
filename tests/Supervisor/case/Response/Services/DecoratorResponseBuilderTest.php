<?php

namespace FragSeb\Supervisor\Test\Response\Services;

use FragSeb\Supervisor\Model\DTO\Process;
use FragSeb\Supervisor\Model\DTO\State;
use FragSeb\Supervisor\Response\Services\ChainDataTransferObject;
use FragSeb\Supervisor\Response\Services\ChainInterface;

/**
 * @covers \FragSeb\Supervisor\Response\Services\ChainDataTransferObject
 */
class ChainDataTransferObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ChainInterface
     */
    private $chain;

    public function setUp()
    {
        $this->chain = new ChainDataTransferObject();
    }

    public function testAddAndHandleValidObject()
    {
        $result = $this->chain->add(Process::class);

        static::assertInstanceOf(ChainInterface::class, $result);
    }

    /**
     * @expectedException \FragSeb\Supervisor\Exception\DataTransferObjectException
     */
    public function testAddAndHandleInvalidObject()
    {
        $this->chain->add(\stdClass::class);
    }

    public function testHandleExistsObject()
    {
        $this->chain->add(State::class);
        $this->chain->add(Process::class);

        $content = [
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
        ];

        $dto = $this->chain->handle(Process::METHOD_NAME, $content);

        static::assertTrue(is_array($dto));
        static::assertInstanceOf(Process::class, array_shift($dto));
    }

    public function testHandleNotExistsObject()
    {
        $content = 123;
        $dto = $this->chain->handle('foo', $content);

        static::assertEquals(123, $dto);
    }
}
