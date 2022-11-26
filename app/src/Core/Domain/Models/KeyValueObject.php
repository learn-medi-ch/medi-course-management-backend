<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use stdClass;

abstract class KeyValueObject
{
    public function __construct(
        public string $name,
        public object $properties
    ) {

    }


    public function setProperty(KeyValue|KeyValueObject $keyValue)
    {
        $this->properties->{$keyValue->name} = $keyValue;
    }

    public function mergeProperty(string $name, KeyValue $keyValue) : self
    {
        if ($this->has($name) === false) {
            $this->properties->{$name} = $keyValue;
            return $this;
        }

        $object = $this->properties->{$name};
        $object->properties->{$keyValue->name} = $keyValue;
        $this->properties->{$name} = $object;
        return $this;

    }


    public function hasProperties() : bool
    {
        return count((array) $this->properties) > 0;
    }

    public function has(string $name) : bool
    {
        if($this->properties === null) {
            return false;
        }
        return property_exists($this->properties, $name);
    }

    public function getProperties() : array
    {
        $keyValues = [];
        foreach ((array) $this->properties as $keyValue) {
            /** @var KeyValue $keyValue */
            $keyValues[$keyValue->name] = $keyValue;
        }
        return $keyValues;
    }
}