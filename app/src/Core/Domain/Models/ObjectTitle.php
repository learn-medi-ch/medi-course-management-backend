<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ObjectTitle extends ObjectInstance
{
    public static function new(RefId $refId, Title $title) : self
    {
        return new self(Value::OBJECT_TITLE, [$refId, $title]);
    }
}