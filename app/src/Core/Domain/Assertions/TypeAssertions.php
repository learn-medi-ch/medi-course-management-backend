<?php

namespace Medi\CourseManagementBackend\Core\Domain\Assertions;

use Exception;

enum TypeAssertions
{
    case INT;
    case STRING;
    case ARRAY;
    case OBJECT;

    /**
     * @throws Exception
     */
    public function assert(int|string|array|object $value) : bool
    {
        //todo
        return match ($this) {
            self::ARRAY => is_array($value) ? true : throw new Exception('invalid type')
        };

        return true;

    }
}