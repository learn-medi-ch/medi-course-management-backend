<?php

namespace Medi\CourseManagementBackend\Adapters\Actions;

use Exception;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

enum Action: string
{
    case ENROLL_TO_COURSE = 'enrollToCourse';

    /**
     * @throws Exception
     */
    function get(IliasRestApiClient $iliasRestApiClient) : EnrollToCourse
    {
        return match ($this) {
            self::ENROLL_TO_COURSE => EnrollToCourse::new($iliasRestApiClient)
        };
    }
}