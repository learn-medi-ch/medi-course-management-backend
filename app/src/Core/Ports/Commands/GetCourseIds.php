<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models;

class GetCourseIds extends CommandInstance
{
    public static function new(
        Models\ParentRefId $parentRefId
    ): self
    {
        return new self(
            Command::GET_COURSE_IDS,
            [$parentRefId]
        );
    }

    /**
     * @return Models\ParentRefId
     */
    public function getParentRefId(): int
    {
        return $this->value->{Models\Value::PARENT_REF_ID->value};
    }
}
