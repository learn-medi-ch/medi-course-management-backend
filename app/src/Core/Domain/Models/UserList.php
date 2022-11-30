<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class UserList extends ValueInstance
{

    /**
     * @param UserList[] $users
     * @return static
     */
    public static function new(array $users) : self
    {
        return new self(Value::USER_LIST->value,
            ValueType::ARRAY,
            $users);
    }
}