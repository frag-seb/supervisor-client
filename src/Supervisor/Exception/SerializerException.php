<?php

namespace FragSeb\Supervisor\Exception;

final class SerializerException extends \RuntimeException implements ExceptionInterface
{
    /**
     * Constructor.
     *
     * @param array $response
     */
    public function __construct(array $response)
    {
        parent::__construct($response['faultString'], $response['faultCode']);
    }
}
