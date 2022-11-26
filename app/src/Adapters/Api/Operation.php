<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Core\Ports;

class Operation
{

    private function __construct(
        public Ports\Command $command,
        public null|Operation $next
    ) {

    }

    public static function new(Ports\Command $command, null|Operation $next = null)
    {
        return new self(
            $command,
            $next,
        );
    }
}