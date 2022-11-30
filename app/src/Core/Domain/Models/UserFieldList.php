<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;


use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class UserFieldList extends ValueInstance
{
    /**
     * @param UserField[] $userFields
     * @return static
     */
    public static function new(array $userFields) : self
    {
        return new self(Value::USER_FIELD_LIST->value,
            ValueType::ARRAY,
            $userFields);
    }
}