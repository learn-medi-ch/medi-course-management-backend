<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ObjectTitleList extends ValueInstance
{
    /**
     * @param ObjectTitle[] $objectTitles
     * @return self
     */
    public static function new(array $objectTitles): self
    {
        return new self(Value::OBJECT_TITLES, Values\ValueType::ARRAY, $objectTitles);
    }
}