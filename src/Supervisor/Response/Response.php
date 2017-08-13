<?php

namespace FragSeb\Supervisor\Response;

class Response implements ResponseInterface
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var mixed
     */
    private $content;

    /**
     * Constructor.
     *
     * @param string $method
     * @param mixed $content
     */
    public function __construct(string $method, $content)
    {
        $this->method = $method;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }
}
