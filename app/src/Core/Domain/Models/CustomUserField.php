<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;


class CustomUserField extends ValueInstance
{
    public static function new(string $name, string $value) : self
    {
        return new self($name,
            $value, []);
    }
}