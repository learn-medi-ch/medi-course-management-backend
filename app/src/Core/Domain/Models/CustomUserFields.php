<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class CustomUserFields extends ValueInstance
{
    /**
     * @param CustomUserField[] $customUserFields
     */
    public static function new(array $customUserFields) : CustomUserFields
    {

        return new self(Value::CUSTOM_USER_FIELDS,
            $customUserFields, []);
    }
}