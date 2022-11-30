<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;
class Institution extends ValueInstance
{
    public static function new(string $value) : self
    {
        return new self(Value::INSTITUTION, Values\ValueType::STRING, $value);
    }
}