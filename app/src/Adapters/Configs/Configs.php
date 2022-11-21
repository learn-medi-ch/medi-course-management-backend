<?php

namespace Medi\CourseManagementBackend\Adapters\Configs;

use Medi\CourseManagementBackend\Core\Ports;

class Configs implements Ports\Configs
{
    public static function new() {
        return new self();
    }
}