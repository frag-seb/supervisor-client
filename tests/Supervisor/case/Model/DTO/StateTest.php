<?php

namespace FragSeb\Supervisor\Test\Model\DTO;

use FragSeb\Supervisor\Model\DTO\State;

/**
 * @covers \FragSeb\Supervisor\Model\DTO\State
 */
class StateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testGetter($config)
    {
        $state = State::create($config);


        static::assertSame(static::constant($config['statename']), $state->getStatecode());
        static::assertSame($config['statename'], $state->getStatename());
        static::assertSame($config['statecode'], $state->getStatecode());
    }

    public function dataProvider()
    {
        return [
            [
                [
                    'statename' => 'FATAL',
                    'statecode' => 2,
                ],
            ],
            [
                [
                    'statename' => 'RUNNING',
                    'statecode' => 1,
                ],
            ],
            [
                [
                    'statename' => 'RESTARTING',
                    'statecode' => 0,
                ],
            ],
            [
                [
                    'statename' => 'SHUTDOWN',
                    'statecode' => -1,
                ],
            ],
        ];
    }

    private static function constant($name)
    {
        return constant("FragSeb\Supervisor\Model\DTO\State::$name");
    }
}
