<?php

namespace Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Core\Domain\Models\RefIds;

interface CourseRepository
{
    public function getRefIds() : RefIds;
}