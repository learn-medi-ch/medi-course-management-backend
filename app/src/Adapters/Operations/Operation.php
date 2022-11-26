<?php

namespace Medi\CourseManagementBackend\Adapters\Operations;

use Exception;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

enum Operation: string
{
    case ENROLL_TO_COURSE = 'enrollToCourse';

    /**
     * @throws Exception
     */
    function get() : EnrollToCourse
    {
        return match ($this) {
            self::ENROLL_TO_COURSE => EnrollToCourse::new(IliasRestApiClient::new())
        };
    }
}