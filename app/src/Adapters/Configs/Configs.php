<?php

namespace Medi\CourseManagementBackend\Adapters\Configs;

use Medi\CourseManagementBackend\Core;

class Configs implements Core\Configs
{
    public static function new() {
        return new self();
    }
}