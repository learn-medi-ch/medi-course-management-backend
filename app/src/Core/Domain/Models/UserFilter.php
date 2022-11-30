<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class UserFilter extends ObjectInstance
{

    /**
     * @param array $customUserFields
     */
    public static function new(array $customUserFields) : UserFilter
    {

        return new self(Value::USER_FILTER->value,
            $customUserFields);
    }
}