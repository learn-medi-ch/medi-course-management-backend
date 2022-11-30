<?php
require_once __DIR__ . '/../../autoload.php';

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Adapters\Api\Process;
use Medi\CourseManagementBackend\Core\Domain\Models;
use \Medi\CourseManagementBackend\Core\Ports;

$onPublish = function ($event) {
    print_r($event);
};

$api = Api::new();

$api->process(
    Process::new(
        [
            Ports\Commands\GetUserIds::new(
                Models\CustomUserFields::new(
                    [
                        Models\CustomUserField::new('Klasse', 'RS_22-25_B')
                    ]
                )
            ),
            Ports\Commands\GetCourseIds::new()
        ],
        Process::new(
            [
                Ports\Commands\EnrollUsersToCourse::new(
                    Models\RefIds::new(
                        []
                    ),
                    Models\UserIds::new(
                        []
                    ),
                )
            ]
        )
    ),
    $onPublish
);