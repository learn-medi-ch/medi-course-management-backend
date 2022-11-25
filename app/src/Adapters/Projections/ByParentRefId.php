<?php

namespace Medi\CourseManagementBackend\Adapters\Projections;

use Medi\CourseManagementBackend\Adapters;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

class ByParentRefId
{

    private function __construct(private Projection $projectionType)
    {

    }

    /**
     * @throws \Exception
     */
    static function new(Projection $projectionType)
    {
        if (in_array($projectionType, [Projection::COURSE_LIST]) === false) {
            throw new \Exception('invalid projection type');
        }
        return new self($projectionType);
    }

    function get(int $parentRefId, bool $deep) : array
    {
        $iliasRestApiClient = IliasRestApiClient::new();
        return match ($this->projectionType) {
            Projection::COURSE_LIST => Adapters\Repositories\CourseRepository::new($iliasRestApiClient)->getList($parentRefId, $deep)
        };
    }
}