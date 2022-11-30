<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;
use Medi\CourseManagementBackend\Core\Domain\Models;

class EnrollUserToCourseAsMember extends CommandInstance
{
    public static function new(
        Models\RefId $refId, Models\UserId $userId
    ) : self {
        return new self(
            Command::ENROLL_MEMBER_TO_COURSE,
            [$refId, $userId]
        );
    }

    public function getUserId() : int
    {
        return $this->value->{Models\Value::USER_ID->value};
    }

    public function getRefId() : int
    {
        return $this->value->{Models\Value::REF_ID->value};
    }
}