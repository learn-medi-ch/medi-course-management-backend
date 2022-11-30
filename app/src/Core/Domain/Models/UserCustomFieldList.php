<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class UserCustomFieldList extends ValueInstance
{
    /**
     * @param UserCustomField[] $customUserFields
     */
    public static function new(array $customUserFields) : UserCustomFieldList
    {

        return new self(Value::USER_CUSTOM_FIELD_LIST->value,
            ValueType::ARRAY,
            $customUserFields);
    }
}