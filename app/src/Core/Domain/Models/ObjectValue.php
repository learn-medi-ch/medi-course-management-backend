<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ObjectValue extends KeyValueObject
{
    public static function new(
        string $key,
        object $value
    ) : self {
        return new self($key, $value);
    }
}