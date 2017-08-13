<?php

namespace FragSeb\Supervisor\Model\DTO;

interface FactoryAwareInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public static function create($data);
}
