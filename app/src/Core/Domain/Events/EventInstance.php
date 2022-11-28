<?php

namespace Medi\CourseManagementBackend\Core\Domain\Events;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\PrimitiveValue;
use Medi\CourseManagementBackend\Core\Domain\Models\Values\ObjectValue;

abstract class EventInstance  extends ObjectValue
{

    /**
     * @param Event $name
     * @param PrimitiveValue[]|ObjectValue[]|[]  $values
     */
    public function __construct(
        Event $name,
        array $values = []
    ) {
        parent::__construct(
            $name->value,
            $values
        );
    }
}