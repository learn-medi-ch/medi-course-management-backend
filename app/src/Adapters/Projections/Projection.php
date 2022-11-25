<?php

namespace Medi\CourseManagementBackend\Adapters\Projections;

use Medi\CourseManagementBackend\Core\Ports;

use Exception;

enum Projection: string implements Ports\Projection
{
    case COURSE_LIST = 'courseList';
    case USER_LIST = 'userList';

    /**
     * @throws Exception
     */
    function byParentRefId(int $parentRefId, bool $deep = false) : array
    {
        return match ($this) {
            self::COURSE_LIST => ByParentRefId::new($this)->get($parentRefId, $deep)
        };
    }

    /**
     * @throws Exception
     */
    function byFieldValue(string $fieldName, string $fieldValue) : array
    {
        return match ($this) {
            self::USER_LIST => ByFieldValue::new($this)->get($fieldName, $fieldValue)
        };
    }
}