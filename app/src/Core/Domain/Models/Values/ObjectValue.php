<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models\Values;

use stdClass;
use Exception;

class ObjectValue implements Value
{
    public string $type;
    public object $value;

    /**
     * @param string $name
     * @param PrimitiveValue[]|ObjectValue[]|[] $values
     */
    public function __construct(
        public string $name,
        array         $values,
    )
    {
        $this->type = ValueType::OBJECT->value;

        $this->value = new stdClass();
        if (count($values) > 0) {
            foreach ($values as $value) {
                $this->setProperty($value);
            }
        }
    }

    /**
     * @param string $name
     * @param PrimitiveValue[]|ObjectValue[] $values
     */
    /*public static function new(
        string $name,
        array $values,
        array $assertions
    ) : self {
        return new self($name, $values);
    }*/


    //todo private?
    public function setProperty(object $value)
    {
        if (property_exists($value, 'value')) {
            $this->value->{$value->name} = $value->value;
        }

        if (property_exists($value, 'properties')) {
            $this->value->{$value->name} = $value;
        }

    }


    public function hasProperties(): bool
    {
        return count((array)$this->value) > 0;
    }

    public function has(string $name): bool
    {
        if ($this->value === null) {
            return false;
        }
        return property_exists($this->value, $name);
    }

    public function getProperty(string $name): PrimitiveValue|ObjectValue
    {
        if ($this->has($name) === false) {
            throw new Exception("property does not exists " . $name);
        }
        return $this->value->{$name};
    }

    public function getValue(): array
    {
        $keyValues = [];
        foreach ((array)$this->value as $keyValue) {
            /** @var PrimitiveValue|ObjectValue $keyValue */
            $keyValues[$keyValue->name] = $keyValue;
        }
        return $keyValues;
    }
}