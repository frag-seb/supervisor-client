<?php

namespace FragSeb\Supervisor\Model\DTO;

class State
{
    const FATAL = 2;
    const RUNNING = 1;
    const RESTARTING = 0;
    const SHUTDOWN = -1;

    /**
     * @var string
     */
    private $statename;

    /**
     * @var int
     */
    private $statecode;

    /**
     * @return string
     */
    public function getStatename(): string
    {
        return $this->statename;
    }

    /**
     * @return int
     */
    public function getStatecode(): int
    {
        return $this->statecode;
    }

    /**
     * @param array $response
     *
     * @return State
     */
    public static function createProcess(array $response): State
    {
        $state = new self();

        $state->statename = $response['statename'] ?? null;
        $state->statecode = $response['statecode'] ?? null;

        return $state;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
    }
}
