<?php

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Adapters\Api\Process;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;

class EnrollToComittee {

    public static function process(
        Models\Institution $institution,
        Models\UserCustomField $customField,
        Models\CourseRoleType $courseRoleType
    ) {


        $api = Api::new();
        $api->process(
            Process::new([
                    Ports\Commands\GetUserIds::new(
                        Models\CustomFields::new([$customField])
                    )
                ],
                Process::new(
                    Ports\Commands\EnrollUsersToCourse::new()
                )
            ),
            $publish
        );
    }

}
