<?php

namespace Medi\CourseManagementBackend\Core\Ports;

interface Publisher {
    function handle(string $jsonData) : void;
}