<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\PrimitiveValue;
use Medi\CourseManagementBackend\Core\Domain\Models\Values\ObjectValue;

abstract class CommandInstance  extends ObjectValue
{

    /**
     * @param Command $name
     * @param PrimitiveValue[]|ObjectValue[]|[]  $values
     */
    public function __construct(
        Command $name,
        array $values = []
    ) {
        parent::__construct(
            $name->value,
            $values
        );
    }
}