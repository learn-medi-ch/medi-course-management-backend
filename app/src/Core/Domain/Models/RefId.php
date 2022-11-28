<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;
class RefId extends ValueInstance
{
    public static function new(int $id) : self
    {
        return new self(Value::REF_ID, $id);
    }
}