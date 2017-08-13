<?php

namespace FragSeb\Supervisor\Response;

use FragSeb\Supervisor\ManagerInterface;
use FragSeb\Supervisor\Response\Services\ChainDataTransferObject;
use FragSeb\Supervisor\Response\Services\ChainInterface;

class DecoratorResponseBuilder implements ResponseBuilderInterface
{
    /**
     * @var ResponseBuilderInterface
     */
    private $builder;

    /**
     * @var ChainInterface
     */
    private $transferObject;

    /**
     * Constructor.
     *
     * @param ResponseBuilderInterface $builder
     */
    public function __construct(ResponseBuilderInterface $builder, ChainInterface $transferObject)
    {
        $this->builder = $builder;
        $this->transferObject = $transferObject;
    }

    /**
     * {@inheritdoc}
     */
    public function build(string $method, $content): ResponseInterface
    {
        $content = $this->beforHandle($method, $content);

        $response = $this->builder->build($method, $content);

        $this->afterHandle($response);

        return $response;
    }

    /**
     * Return the content for the ResponseBuilder.
     *
     * @param $method
     * @param $content
     *
     * @return mixed
     */
    protected function beforHandle(string $method, $content)
    {
        return $this->transferObject->handle($method, $content);
    }

    /**
     * @param ResponseInterface $response
     */
    protected function afterHandle(ResponseInterface $response)
    {
    }
}
