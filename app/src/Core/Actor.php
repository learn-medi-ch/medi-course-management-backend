<?php

namespace Medi\CourseManagementBackend\Core;

class Actor
{
    private Configs $configs;

    private function __construct(Configs $configs)
    {
        $this->configs = $configs;
    }

    public static function new(Configs $configs) : self
    {
        return new self($configs);
    }

    public function projectKeyValueList(callable $publish) {

    }

}