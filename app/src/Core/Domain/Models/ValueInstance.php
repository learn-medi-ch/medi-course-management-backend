<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\PrimitiveValue;

abstract class ValueInstance extends PrimitiveValue
{
    public function __construct(
        Value|string $name,
        public string|array|int $value,
    ) {
        if (is_object($name)) {
            $name = $name->value;
        }

        parent::__construct(
            $name,
            $value
        );
    }
}