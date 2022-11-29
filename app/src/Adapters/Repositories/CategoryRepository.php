<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Domain\Models\ObjectTitleList;
use Medi\CourseManagementBackend\Core\Ports;


use Medi\CourseManagementBackend\Adapters\Formatter;
use Medi\CourseManagementBackend\Core\Domain\Models\RefIds;
use stdClass;

class CategoryRepository implements Ports\CategoryRepository
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
        $obj->ref_id = 82;
        $obj->title = "category 1";
        return [$obj];


        //todo $deep;
        //print_r($this->iliasRestApiClient->getChildrenByRefId($parentRefId, DefaultObjectType::CATEGORY));
        exit;
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