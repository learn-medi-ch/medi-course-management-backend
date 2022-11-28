<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models\Values;

abstract class PrimitiveValue implements Value
{

    public function __construct(
        public string $name,
        public string|array|int $value
    ) {

    }

}