<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Domain\Models\ObjectTitleList;
use Medi\CourseManagementBackend\Core\Ports;

use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\DefaultObjectType;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Object\ObjectDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDiffDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\CourseMember\CourseMemberDto;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\Role\RoleDto;

use Medi\CourseManagementBackend\Adapters\Formatter;
use stdClass;
use Medi\CourseManagementBackend\Core\Domain\Models\RefIds;

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
        //e.g. http://127.0.0.11/flux-ilias-rest-api-proxy/crsmgmt-backend/parentRefId/81/getCourseIds
        return $this->iliasRestApiClient->getChildrenByRefId($parentRefId);
    }

    public function enrollToCourse(int $refId, int $userId) : void
    {
        $diff = CourseMemberDiffDto::new(true);
        $this->iliasRestApiClient->addCourseMemberByRefIdByUserId($refId, $userId, $diff);
    }

    public function getRefIds(int $parentRefId) : RefIds
    {
        return Formatter\RefIdsFormatter::new()->format($this->getList($parentRefId));
    }

    public function getTitles(int $parentRefId): ObjectTitleList
    {
        return Formatter\ObjectTitleListFormatter::new()->format($this->getList($parentRefId));
    }
}