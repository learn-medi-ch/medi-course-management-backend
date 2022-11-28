<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models\Values;

use stdClass;
use Exception;

class ObjectValue implements Value
{
    public object $properties;

    /**
     * @param string                         $name
     * @param PrimitiveValue[]|ObjectValue[]|[] $values
     */
    public function __construct(
        public string $name,
        array $values,
    ) {
        $this->properties = new stdClass();
        if(count($values) > 0) {
            foreach($values as $value) {
                $this->setProperty($value);
            }
        }
    }

    /**
     * @param string                         $name
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
    public function setProperty(Object $value)
    {
        if(property_exists($value, 'value')) {
            $this->properties->{$value->name} = $value->value;
        }

        if(property_exists($value, 'properties')) {
            $this->properties->{$value->name} = $value;
        }

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

    public function getProperty(string $name) : PrimitiveValue|ObjectValue
    {
        if($this->has($name) === false) {
            throw new Exception("property does not exists ".$name);
        }
        return $this->properties->{$name};
    }

    public function getProperties() : array
    {
        $keyValues = [];
        foreach ((array) $this->properties as $keyValue) {
            /** @var PrimitiveValue|ObjectValue $keyValue */
            $keyValues[$keyValue->name] = $keyValue;
        }
        return $keyValues;
    }
}