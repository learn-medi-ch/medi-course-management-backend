<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models;

class GetCourseTitles extends CommandInstance
{
    public static function new(
        Models\ParentRefId $parentRefId
    ): self
    {
        return new self(
            Command::GET_COURSE_TITLES,
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