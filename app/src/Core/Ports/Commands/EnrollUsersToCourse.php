<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;
use Medi\CourseManagementBackend\Core\Domain\Models;

class EnrollUsersToCourse extends CommandInstance
{
    public static function new(
        Models\RefId $refId, Models\UserIds $userIds, Models\CourseRoleType $courseRoleType
    ) : self {
        return new self(
            Command::ENROLL_MEMBERS_TO_COURSES,
            [$refId, $userIds, $courseRoleType]
        );
    }

    /**
     * @return Models\UserId[]
     */
    public function getUserIds() :array
    {
        return $this->value->{Models\Value::USER_IDS->value};
    }

    /**
     * @return Models\RefId[]
     */
    public function getRefId() : array
    {
        return $this->value->{Models\Value::REF_ID->value};
    }

    /**
     * @return string
     */
    public function getCourseRoleType() : string
    {
        return $this->value->{Models\Value::COURSE_ROLE_TYPE->value};
    }
}