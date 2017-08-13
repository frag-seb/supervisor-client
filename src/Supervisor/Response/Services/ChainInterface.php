<?php

namespace FragSeb\Supervisor\Response\Services;

interface ChainInterface
{
    /**
     * @param string $modelName
     *
     * @return ChainInterface
     */
    public function add(string $modelName);

    /**
     * @param string $func
     * @param        $content
     *
     * @return mixed
     */
    public function handle(string $func, $content);
}
