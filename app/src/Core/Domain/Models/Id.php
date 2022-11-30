<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;
class Id extends ValueInstance
{
    public static function new(int $id) : self
    {
        return new self(Value::ID, Values\ValueType::INT, $id);
    }
}