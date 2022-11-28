<?php

namespace Medi\CourseManagementBackend\Core\Domain\Events;

use Medi\CourseManagementBackend\Core\Domain\Models;

class MemberEnrolledToCourse extends EventInstance
{
    public static function new(
        Models\RefId $refId,
        Models\UserId $userId
    ) : self {
        return new self(
            Event::MEMBER_ENROLLED_TO_COURSE,
            [$refId, $userId]
        );
    }
}