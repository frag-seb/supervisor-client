<?php

namespace FragSeb\Supervisor\Test\Client;

use FragSeb\Supervisor\Client\Client;
use FragSeb\Supervisor\Connector\ConnectorInterface;
use FragSeb\Supervisor\Model\DTO\State;
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
     * @dataProvider apiProvider
     */
    public function testClientGetter($callNamespace, $arguments, $expected)
    {
        list($namspace, $method) = explode('.', $callNamespace);

        $this->expandConnectorMock($callNamespace, $arguments, $expected);

        $actual = $this->client->{$method}();

        static::assertEquals($expected, $actual);
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
                'supervisor.getState',
                [],
                [
                    'statename' => 'RUNNING',
                    'statecode' => State::RUNNING,
                ],
            ],
            [
                'supervisor.getState',
                [],
                [
                    'statename' => 'RESTARTING',
                    'statecode' => State::RESTARTING,
                ],
            ],
            [
                'supervisor.getState',
                [],
                [
                    'statename' => 'SHUTDOWN',
                    'statecode' => State::SHUTDOWN,
                ],
            ],
            [
                'supervisor.getState',
                [],
                [
                    'statename' => 'RUNNING',
                    'statecode' => 1,
                ],
            ],
        ];
    }

    protected function setUp()
    {
        $this->connector = \Mockery::mock(ConnectorInterface::class);

        $this->client = new Client($this->connector);
    }

    private function expandConnectorMock($callNamespace, $arguments, $return)
    {
        $this
            ->connector
            ->shouldReceive('call')
            ->withArgs([$callNamespace, $arguments])
            ->andReturn($return)
        ;
    }
}
