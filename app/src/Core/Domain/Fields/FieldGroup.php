<?php

namespace Medi\CourseManagementBackend\Core\Domain\Fields;

use Exception;

class FieldGroup
{


    /**
     * @param Field[] $fields
     */
    private function __construct(
        public string $groupName,
        public array $fields
    )
    {
        foreach ($fields as $field) {
            $this->fields[$field->name] = $field->value;
        }
    }


    /**
     * @param Field[] $fields
     * @return static
     */
    public static function new(string $fieldGroupName, array $fields): self
    {
        return new self($fieldGroupName, $fields);
    }

    public function has(string $name): bool
    {
        return isset($this->fields[$name]);
    }

    public function get($name): string
    {
        if (isset($this->fields[$name])) {
            return $this->fields[$name];
        }

        throw new Exception("$name dow not exists");
    }

    public function __get($name): string
    {
        return $this->get($name);
    }
}