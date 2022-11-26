<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Ports;

use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\DefaultObjectType;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Role\RoleDto;

use Medi\CourseManagementBackend\Adapters\Formatter;
use stdClass;
use Medi\CourseManagementBackend\Core\Domain\Models\ArrayValue;

class CourseRepository implements Ports\CourseRepository
{
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient)
    {
    }

    public static function new(IliasRestApiClient $iliasRestApiClient)
    {
        return new self($iliasRestApiClient);
    }

    public function getList(int $parentRefId, bool $deep = false) : array
    {
        $obj = new stdClass();
        $obj->ref_id = 2;
        return [$obj];
        //todo $deep;
        return $this->iliasRestApiClient->getChildrenByRefId($parentRefId, DefaultObjectType::COURSE) ?? [];
    }

    public function enrollToCourse(int $refId, int $userId) : void
    {
        $diff = CourseMemberDiffDto::new(true);
        $this->iliasRestApiClient->addCourseMemberByRefIdByUserId($refId, $userId, $diff);
    }

    public function getRefIds() : ArrayValue
    {
        return Formatter\RefIdArrayFormatter::new()->format($this->getList(1));
    }
}