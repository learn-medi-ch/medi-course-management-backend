<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;
class Title extends ValueInstance
{
    public static function new(string $title) : self
    {
        return new self(Value::TITLE, Values\ValueType::STRING, $title);
    }
}