<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\DefaultObjectType;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDto;

class CourseRepository {
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient) { }

    public static function new(IliasRestApiClient $iliasRestApiClient) {
        return new self($iliasRestApiClient);
    }

    public function getList(int $parentRefId): array {
        return $this->iliasRestApiClient->getChildrenByRefId($parentRefId, DefaultObjectType::COURSE) ?? [];
    }

}