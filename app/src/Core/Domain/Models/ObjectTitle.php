<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class ObjectTitle extends ObjectInstance
{
    public static function new(RefId $refId, Title $title): self
    {
        return new self(Value::OBJECT_TITLE->value . "/" . $refId->name . "/" . $refId->value, [Id::new($refId->value), $refId, $title]);
    }
}