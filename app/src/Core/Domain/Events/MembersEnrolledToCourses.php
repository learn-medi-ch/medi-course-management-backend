<?php

namespace Medi\CourseManagementBackend\Core\Domain\Events;

use Medi\CourseManagementBackend\Core\Domain\Models;

class MembersEnrolledToCourses extends EventInstance
{
    public static function new(
        Models\RefIds $refIds,
        Models\UserIds $userIds
    ) : self {
        return new self(
            Event::MEMBERS_ENROLLED_TO_COURSES,
            [$refIds, $userIds]
        );
    }
}