<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ArrayValue extends KeyValue
{
    public static function new(
        string $key,
        array $value
    ) : self {
        return new self($key, $value);
    }
}