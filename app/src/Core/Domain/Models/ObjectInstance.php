<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\PrimitiveValue;
use Medi\CourseManagementBackend\Core\Domain\Models\Values\ObjectValue;

abstract class ObjectInstance extends ObjectValue
{

    /**
     * @param Value                          $name
     * @param PrimitiveValue[]|ObjectValue[] $values
     */
    public function __construct(
        string $name,
       array $values,
    ) {
        parent::__construct(
            $name,
            $values
        );
    }
}