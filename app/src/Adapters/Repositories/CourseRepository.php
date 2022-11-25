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

    public function getList(int $parentRefId): string {
        return json_encode(array_map(fn(ObjectDto $object): array => ["refId" => $object->ref_id, "title" => $object->title, "description" => $object->description], $this->iliasRestApiClient->getChildrenByRefId($parentRefId, DefaultObjectType::COURSE) ?? []));
    }

}