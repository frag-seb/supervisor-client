<?php

namespace FragSeb\Supervisor\Model;

class Server
{
    const DEFAULT_HOST = 'http://127.0.0.1:9001/RPC2';

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $host;

    /**
     * @var array
     */
    private $auth;

    /**
     * Constructor.
     *
     * @param        $identifier
     * @param        $name
     * @param string $host
     * @param array  $auth
     */
    public function __construct($identifier, $name, string $host, array $auth)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->host = $host;

        $this->auth = $auth;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
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
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string|null
     */
    public function getUsername()
    {
        return $this->auth['username'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->auth['password'] ?? null;
    }
}
