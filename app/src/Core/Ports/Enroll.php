<?php

namespace Medi\CourseManagementBackend\Core\Ports;

interface Enroll extends Operation {
    function handle(int $refId, int $userId) : void;
}