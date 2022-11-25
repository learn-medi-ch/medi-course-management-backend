<?php

namespace Medi\CourseManagementBackend\Adapters\Publishers;

use Medi\CourseManagementBackend\Core\Ports;
use stdClass;

class JsonDataPublisher
{

    public function __construct()
    {
    }

    public static function new()
    {
        return new self();
    }

    function publish(string $jsonData, callable $publishTo) : void
    {
        $publishTo($jsonData);
    }
}