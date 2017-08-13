<?php

namespace FragSeb\Supervisor\Response;

interface ResponseInterface
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return mixed
     */
    public function getContent();
}
