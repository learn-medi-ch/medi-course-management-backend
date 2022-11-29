<?php

namespace Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Core\Domain\Models\ObjectTitleList;
use Medi\CourseManagementBackend\Core\Domain\Models\RefIds;

interface CategoryRepository
{
    public function getRefIds(int $parentRefId) : RefIds;
    public function getTitles(int $parentRefId) : ObjectTitleList;
}