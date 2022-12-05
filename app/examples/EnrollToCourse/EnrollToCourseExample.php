<?php
require_once '../../autoload.php';

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;

$publish = function (object $event) {
    print_r($event);
};

$api = Api::new();
$api->process(
    \Medi\CourseManagementBackend\Adapters\Api\Process::new([
            Ports\Commands\GetUserIds::new(
                Models\CustomFields::new(
                    [Models\UserCustomField::new('Klasse', 'test')]
                )
                ),
                Ports\Commands\GetCourseIds::new(Models\ParentRefId::new(3))
        ]
    ),
    $publish
);