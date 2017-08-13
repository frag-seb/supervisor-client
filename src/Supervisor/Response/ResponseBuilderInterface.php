<?php

namespace FragSeb\Supervisor\Response;

interface ResponseBuilderInterface
{
    /**
     * @param string $method
     * @param mixed $content
     *
     * @return ResponseInterface
     */
    public function build(string $method, $content): ResponseInterface;
}
