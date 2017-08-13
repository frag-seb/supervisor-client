<?php

namespace FragSeb\Supervisor\Response\Services;

use FragSeb\Supervisor\Exception\DataTransferObjectException;
use FragSeb\Supervisor\Model\DTO\FactoryAwareInterface;

class ChainDataTransferObject implements ChainInterface
{
    /**
     * @var \ArrayIterator
     */
    private $models;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->models = new \ArrayIterator();
    }

    /**
     * {@inheritdoc}
     */
    public function add(string $modelName)
    {
        if (FactoryAwareInterface::class !== key(class_implements($modelName))) {
            throw new DataTransferObjectException(
                'The given modelName model does not implement the correct interface (FactoryAwareInterface).'
            );
        }

        $this->models->offsetSet($modelName, $modelName);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(string $func, $content)
    {
        foreach ($this->models as $class) {
            if ($this->support($func, $class)) {
                return $class::create($content);
            }
        }

        return $content;
    }

    /**
     * @param $func
     * @param $class
     *
     * @return bool
     */
    protected function support($func, $class)
    {
        if ($func === $class::METHOD_NAME) {
            return true;
        }

        return false;
    }
}
