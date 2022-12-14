<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models\Values;

abstract class PrimitiveValue implements Value
{

    public function __construct(
        public string $name,
        public string $type,
        public string|array|int|bool $value

    ) {

    }

}