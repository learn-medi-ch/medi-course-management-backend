<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Adapters\CommandInstances\CommandInstances;
use Medi\CourseManagementBackend\Core\Ports;

class Process
{

    /**
     * @param Ports\Commands\CommandInstance[] $commands
     * @param Process|null                     $next
     */
    private function __construct(
        public array $commands,
        public null|Process $next
    ) {

    }

    /**
     * @param Ports\Commands\CommandInstance[] $commands
     * @param Process|null                     $next
     * @return Process
     */
    public static function new(array $commands, null|Process $next = null)
    {
        return new self(
            $commands,
            $next,
        );
    }

    public static function fromPayload(object $payload) : self
    {
        $next = null;
        if(property_exists($payload, 'next')) {
            if ($payload->next) {print_r($payload->next);
                $next = Process::fromPayload($payload->next);
            }
        }
        
        return new self(
            CommandInstances::fromArray($payload->commands)->array,
            $next
        );
    }

}