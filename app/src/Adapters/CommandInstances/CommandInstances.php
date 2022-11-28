<?php

namespace Medi\CourseManagementBackend\Adapters\CommandInstances;

use Medi\CourseManagementBackend\Core\Ports;

class CommandInstances
{

    /**
     * @param Ports\Commands\CommandInstance[] $array
     */
    private function __construct(public array $array)
    {

    }

    /**
     * @param Object[] $commands
     * @return void
     */
    public static function fromArray(array $commands) : self
    {
        $commandInstances = [];
        foreach ($commands as $command) {
            $payload = null;
            if (property_exists($command, 'payload')) {
                $payload = $command->payload;
            }
            $commandInstances[] = Ports\Commands\Command::from($command->name)->get($payload);
        }
        return new self($commandInstances);
    }
}