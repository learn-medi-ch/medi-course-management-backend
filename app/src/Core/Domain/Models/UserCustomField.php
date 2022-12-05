<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class UserCustomField
{
    private function __construct(
        public string $name, public string $value
    )
    {

    }

    public static function new(string $name, string $value): self
    {
        return new self($name, $value);
    }
}