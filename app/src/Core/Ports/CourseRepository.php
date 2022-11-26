<?php

namespace Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Core\Domain\Models\ArrayValue;

interface CourseRepository
{
    public function getRefIds() : ArrayValue;
}