<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use  Medi\CourseManagementBackend\Core\Domain\Models;

use stdClass;

class GetCourseIds extends Command
{
    public static function new() : self
    {
        $obj = new self(Models\Keywords::GET_COURSE_IDS->value, new stdClass());
        return $obj;
    }
}