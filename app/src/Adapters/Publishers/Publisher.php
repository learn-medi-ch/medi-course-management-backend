<?php

namespace Medi\CourseManagementBackend\Adapters\Publishers;

use Medi\CourseManagementBackend\Core\Ports;

use Exception;

enum Publisher: string
{
    case JSON_DATA_PUBLISHER = 'jsonDataPublisher';

    /**
     * @throws Exception
     */
    function get($publishTo) : Ports\Publisher
    {
        $publishTo = new class($publishTo) implements Ports\Publisher {
            public function __construct(private $publishTo) { }
            function handle(string $jsonData) : void
            {
                JsonDataPublisher::new()->publish($jsonData, $this->publishTo);
            }
        };

        return match ($this) {
            Publisher::JSON_DATA_PUBLISHER => $publishTo
        };
    }
}