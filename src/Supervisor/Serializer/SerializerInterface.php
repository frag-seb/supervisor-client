<?php

namespace FragSeb\Supervisor\Serializer;

use FragSeb\Supervisor\Exception\SerializerException;

interface SerializerInterface
{
    /**
     * @param $body
     *
     * @return array
     *
     * @throws SerializerException
     */
    public function dencode($body);

    /**
     * @param string $method
     * @param array  $params
     *
     * @return string
     */
    public function encode(string $method, $params = []): string;
}
