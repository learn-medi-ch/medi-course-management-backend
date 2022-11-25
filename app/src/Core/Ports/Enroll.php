<?php

namespace Medi\CourseManagementBackend\Core\Ports;

interface Enroll {
    function handle(int $refId, int $userId) : void;
}