<?php

namespace FragSeb\Supervisor\Model\DTO;

class Process
{
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
     * @param array $response
     *
     * @return Process
     */
    public static function createProcess(array $response): Process
    {
        $process = new self();

        $process->pid = $response['pid'] ?? null;
        $process->name = $response['name'] ?? null;
        $process->group = $response['group'] ?? null;
        $process->statename = $response['statename'] ?? null;
        $process->isRunning = (bool) (static::RUNNING === intval($response['state']));

        $start = \DateTime::createFromFormat('U', $response['start']);
        $now = \DateTime::createFromFormat('U', $response['now']);

        $process->uptime = $start->diff($now)->format('%R%a days') ?? null;

        return $process;
    }

    /**
     * Constructor.
     */
    private function __construct()
    {
    }
}
