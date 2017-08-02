<?php

namespace FragSeb\Supervisor\Connector;

use FragSeb\Supervisor\Exception\ConnectionException;
use FragSeb\Supervisor\Model\Server;
use FragSeb\Supervisor\Serializer\SerializerInterface;

class XmlRpcConnector implements ConnectorInterface
{
    /**
     * @var Server
     */
    private $server;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var array
     */
    private $header = [];

    /**
     * Constructor.
     *
     * @param Server              $server
     * @param SerializerInterface $serializer
     */
    public function __construct(Server $server, SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        $this->server = $server;

        $this->addHeader('content-type', 'Content-Type: text/xml');

        $this->addHeader(
            'authorization',
            sprintf(
                'Authorization: Basic %s',
                base64_encode(sprintf('%s:%s', $server->getUsername(), $server->getPassword()))
            )
        );
    }

    /**
     * Todo: The error handling move to the middleware.
     *
     * {@inheritdoc}
     */
    public function call($method, $arguments = [])
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new ConnectionException($message, $severity, $severity, $file, $line);
        });

        $file = file_get_contents(
            $this->server->getHost(),
            false,
            $this->getContext($method, $arguments)
        );

        restore_error_handler();

        return $this->serializer->dencode($file);
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addHeader(string $name, string $value)
    {
        $this->header[$name] = $value;
    }

    /**
     * @return array
     */
    private function getHeader(): array
    {
        return array_values($this->header);
    }

    /**
     * @param string $method
     * @param array  $arguments
     *
     * @return resource
     */
    private function getContext(string $method, $arguments)
    {
        return stream_context_create(
            [
                'http' => [
                    'method' => 'POST',
                    'header' => $this->getHeader(),
                    'content' => $this->serializer->encode($method, $arguments),
                    'timeout' => 5,
                ],
            ]
        );
    }
}
