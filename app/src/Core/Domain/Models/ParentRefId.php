<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ParentRefId extends ValueInstance
{
    public static function new(int $id) : self
    {
        return new self(Value::PARENT_REF_ID, Values\ValueType::INT, $id);
    }
}