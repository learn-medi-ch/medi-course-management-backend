<?php

namespace Medi\CourseManagementBackend\Adapters\Projections;

use Medi\CourseManagementBackend\Adapters;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

class ByFieldValue
{

    private function __construct(private Projection $projectionType)
    {

    }

    /**
     * @throws \Exception
     */
    static function new(Projection $projectionType)
    {
        if (in_array($projectionType, [Projection::USER_LIST]) === false) {
            throw new \Exception('invalid projection type');
        }
        return new self($projectionType);
    }

    function get(string $fieldName, string $fieldValue) : array
    {
        $iliasRestApiClient = IliasRestApiClient::new();
        return match ($this->projectionType) {
            Projection::USER_LIST => Adapters\Repositories\UserRepository::new($iliasRestApiClient)->byCustomField($fieldName,$fieldValue)
        };
    }
}