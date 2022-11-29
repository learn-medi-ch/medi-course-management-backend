<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values;

class UserIds extends ValueInstance
{
    /**
     * @param  UserId[] $ids
     * @return self
     */
    public static function new(array $ids) : self
    {
        return new self(Value::USER_IDS, Values\ValueType::ARRAY, $ids);
    }
}