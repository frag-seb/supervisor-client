<?php

namespace FragSeb\Supervisor\Model\DTO;

final class State implements FactoryAwareInterface
{
    const METHOD_NAME = 'getState';

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
     * @param array $data
     *
     * @return self
     */
    public static function create($data): self
    {
        $state = new self();

        $state->statename = $data['statename'] ?? null;
        $state->statecode = $data['statecode'] ?? null;

        return $state;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
    }
}
