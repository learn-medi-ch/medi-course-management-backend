<?php

namespace Medi\CourseManagementBackend\Core\Domain\Fields;

class Field
{
    private function __construct(
        public string $name, public string $value, public ?string $fieldType
    )
    {

    }

    public static function new(string $name, string $value, ?string $fieldType = null): self
    {
        return new self($name, $value, $fieldType);
    }

    public function hasType(): bool
    {
        return !is_null($this->fieldType);
    }
}