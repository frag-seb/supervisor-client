<?php

namespace FragSeb\Supervisor\Model;

class Server
{
    const DEFAULT_HOST = 'http://127.0.0.1:9001/RPC2';

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $host = self::DEFAULT_HOST;

    /**
     * @var array
     */
    private $auth;

    /**
     * Constructor.
     *
     * @param string $id
     * @param string $host
     * @param array  $auth
     */
    public function __construct($id, string $host, array $auth)
    {
        $this->id = $id;
        $this->host = $host;

        $this->auth = $auth;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->auth['username'] ?? null;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->auth['password'] ?? null;
    }
}
