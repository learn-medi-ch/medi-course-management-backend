<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

class GetCourseIds extends CommandInstance
{
    public static function new(

    ) : self {
        return new self(
            Command::GET_COURSE_IDS
        );
    }
}