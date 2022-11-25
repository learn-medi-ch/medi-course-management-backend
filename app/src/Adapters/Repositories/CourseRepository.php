<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\DefaultObjectType;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Role\RoleDto;

class CourseRepository
{
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient)
    {
    }

    public static function new(IliasRestApiClient $iliasRestApiClient)
    {
        return new self($iliasRestApiClient);
    }

    public function getList(int $parentRefId, bool $deep) : array
    {
        //todo $deep;
        return $this->iliasRestApiClient->getChildrenByRefId($parentRefId, DefaultObjectType::COURSE) ?? [];
    }

    public function enrollToCourse(int $refId, int $userId) : void
    {
        $diff = CourseMemberDiffDto::new(true);
        $this->iliasRestApiClient->addCourseMemberByRefIdByUserId($refId, $userId, $diff);
    }

}