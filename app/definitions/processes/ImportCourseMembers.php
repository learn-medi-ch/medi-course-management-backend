<?php
require_once __DIR__.'/../../autoload.php';

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Adapters\Api\Process;

$publish = function (object $event) {
    print_r($event);
};

$api = Api::new();
$api->process(
        Process::new([
            Ports\Commands\ImportUsers::new(

            )
        ]
    ),
    $publish
);