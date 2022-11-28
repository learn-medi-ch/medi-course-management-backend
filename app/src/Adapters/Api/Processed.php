<?php

namespace Medi\CourseManagementBackend\Adapters\Api;

use Medi\CourseManagementBackend\Core\Domain\Models\Values\ObjectValue;
use Medi\CourseManagementBackend\Core\Domain\Models\Values\PrimitiveValue;

class Processed extends ObjectValue
{
    /**
     * @param PrimitiveValue[]|ObjectValue[]|[]  $values
     */
    public function __construct(
        array $values = []
    ) {
        parent::__construct(
            'Processed',
            $values
        );
    }

    public static function new(
        array $result
    ) : self {
        return new self(
            $result
        );
    }
}