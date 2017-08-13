<?php

namespace FragSeb\Supervisor\Model\DTO;

class Process implements FactoryAwareInterface
{
    const METHOD_NAME = 'getAllProcessInfo';

    const STOPPED = 0;
    const STARTING = 10;
    const RUNNING = 20;
    const BACKOFF = 30;
    const STOPPING = 40;
    const EXITED = 100;
    const FATAL = 200;
    const UNKNOWN = 1000;

    /**
     * @var int
     */
    private $pid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $group;

    /**
     * @var string
     */
    private $statename;

    /**
     * @var bool
     */
    private $isRunning = false;

    /**
     * @var string
     */
    private $uptime;

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getGroup(): string
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getStatename(): string
    {
        return $this->statename;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    /**
     * @return string
     */
    public function getUptime(): string
    {
        return $this->uptime;
    }

    /**
     * @param array $data
     *
     * @return array|Process[]
     */
    public static function create($data)
    {
        $processes = [];

        foreach ($data as $process) {
            $self = new self();

            $self->pid = $process['pid'] ?? null;
            $self->name = $process['name'] ?? null;
            $self->group = $process['group'] ?? null;
            $self->statename = $process['statename'] ?? null;
            $self->isRunning = (bool) (static::RUNNING === intval($process['state'] ?? static::UNKNOWN));

            $start = \DateTime::createFromFormat('U', $process['start']);
            $now = \DateTime::createFromFormat('U', $process['now']);

            $self->uptime = $start->diff($now)->format('%R%a days');

            $processes[] = $self;
        }

        return $processes;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
    }
}
