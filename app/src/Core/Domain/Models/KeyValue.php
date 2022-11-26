<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

abstract class KeyValue
{

    public function __construct(
        public string $name,
        public string|array|int $value
    ) {

    }

}