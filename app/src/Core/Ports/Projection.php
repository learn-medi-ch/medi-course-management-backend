<?php

namespace Medi\CourseManagementBackend\Core\Ports;

interface Projection {
    function byParentRefId(int $parentRefIdOrRefId) : array|object;
}