<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;


use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class UserCustomField extends ValueInstance
{
    public static function new(string $name, string $value) : self
    {
        return new self($name,Values\ValueType::STRING, $value);
    }
}