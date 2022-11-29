<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;
use Medi\CourseManagementBackend\Core\Domain\Models;

class EnrollMembersToCourses extends CommandInstance
{
    public static function new(
        Models\RefIds $refIds, Models\UserIds $userIds
    ) : self {
        return new self(
            Command::ENROLL_MEMBERS_TO_COURSES,
            [$refIds, $userIds]
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
    public function getRefIds() : array
    {
        return $this->value->{Models\Value::REF_IDS->value};
    }
}