<?php

namespace FragSeb\Supervisor\Serializer;

use FragSeb\Supervisor\Exception\SerializerException;

final class XmlRpcSerializer implements SerializerInterface
{
    /**
     * {@inheritdoc}
     */
    public function dencode($body)
    {
        $response = \xmlrpc_decode($body, 'utf-8');
        if (is_array($response) && \xmlrpc_is_fault($response)) {
            throw new SerializerException($response);
        }

        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function encode(string $method, $params = []): string
    {
        $request = xmlrpc_encode_request($method, $params, ['encoding' => 'utf-8']);

        return $request;
    }
}
