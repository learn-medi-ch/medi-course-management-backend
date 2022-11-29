<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class RefIds extends ValueInstance
{
    /**
     * @param RefId[] $ids
     * @return self
     */
    public static function new(array $ids) : self
    {
        return new self(Value::REF_IDS,  Values\ValueType::ARRAY, $ids);
    }
}