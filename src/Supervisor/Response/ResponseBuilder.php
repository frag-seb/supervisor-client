<?php

namespace FragSeb\Supervisor\Response;

final class ResponseBuilder implements ResponseBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function build(string $method, $content): ResponseInterface
    {
        return new Response($method, $content);
    }
}
