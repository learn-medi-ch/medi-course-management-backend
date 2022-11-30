<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\ValueType;

class Params extends ObjectInstance
{
    /**
     * @param ValueInstance[] $params
     * @return self
     */
    public static function new(array $params) : self
    {
        return new self(Value::PARAMS,  $params);
    }
}