<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class UserId extends ValueInstance
{
    public static function new(int $id) : UserId
    {
        return new self(Value::USER_ID, $id);
    }
}