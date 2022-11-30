<?php
require_once __DIR__ . '/../../autoload.php';
require __DIR__ . '/../../libs/SimpleXLSX.php';
require_once __DIR__ . '/ImportUserFieldMapping.php';
require_once __DIR__ . '/ImportUserMapping.php';

use Medi\CourseManagementBackend\Core\Domain\Models\UserList;
use Shuchkin\SimpleXLSX;

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Adapters\Api\Process;

class ImportUsers {

    public static function process(string $institution) {
        $publish = function (object $event) {
            print_r($event);
        };
        $getUsersFromExcel = function ($institution): UserList {
            $users = [];
            if ($xlsx = SimpleXLSX::parse(__DIR__ . "/../../data/".ImportUserFileName::from($institution)->value)) {
                foreach ($xlsx->rows() as $row) {
                    $users[] = ImportUserMapping::fromRow($row);
                }
            } else {
                echo SimpleXLSX::parseError();
            }
            return UserList::new($users);
        };


        $api = Api::new();
        $api->process(
            Process::new([
                    Ports\Commands\ImportUsers::new(
                        $getUsersFromExcel($institution)
                    )
                ]
            ),
            $publish
        );
    }

}
