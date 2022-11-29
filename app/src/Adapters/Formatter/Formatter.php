<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;

use Exception;

enum Formatter: string
{
    case KEY_VALUE_LIST = 'keyValueList';
    case OBJ_ID_ARRAY = 'objIdArray';
    case REF_ID_ARRAY = 'refIdArray';

    /**
     * @throws Exception
     */
    function format(array $listOrObject) : array|object
    {
        return match ($this) {
            self::KEY_VALUE_LIST => KeyValueListFormatter::new()->format($listOrObject),
            self::OBJ_ID_ARRAY => ObjIdArrayFormatter::new()->format($listOrObject),
            self::REF_ID_ARRAY => RefIdsFormatter::new()->format($listOrObject)
        };
    }
}