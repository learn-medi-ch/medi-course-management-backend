<?php

namespace Medi\CourseManagementBackend\Core\Ports;

class Service
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

    public function command(string $actorId, string $requestUri, array $requestContent) : void
    {
        print_r(get_defined_vars());
    }

    public function query(string $actorId, string $requestUri, array $requestContent) : array
    {
        print_r(get_defined_vars());
    }

}