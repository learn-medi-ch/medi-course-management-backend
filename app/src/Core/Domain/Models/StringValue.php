<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class StringValue extends KeyValue
{
    public static function new(
        string $key,
        string $value
    ) : self {
        return new self($key, $value);
    }
}