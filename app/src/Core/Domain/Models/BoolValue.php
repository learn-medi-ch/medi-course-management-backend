<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class BoolValue extends ValueInstance
{
    public static function new(bool $bool) : BoolValue
    {
        return new self(Value::BoolValue, Values\ValueType::BOOLEAN, $bool);
    }
}