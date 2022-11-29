<?php
require_once '../../autoload.php';
use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Adapters\Api\Operation;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;

$publish = function(object $event) {
  print_r($event);
};

$api = Api::new();
$api->process(
    Operation::new(
        Ports\GetUserIds::new(
            Models\UserFilter::new()->appendCustomUserFieldsFilter(
                Models\StringValue::new(
                    'Klasse', 'test'
                )
            )
        ),
        Operation::new(
            Ports\GetCourseIds::new()
        )
    ),
    $publish
);