<?php
require_once __DIR__ . '/ImportUserFieldMapping.php';
require_once __DIR__ . '/ImportUserMapping.php';

use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Adapters\Api\Process;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;
use Shuchkin\SimpleXLSX;

class ImportUsers {

    public static function process(Models\Institution|Models\ValueInstance $institution) {
        $publish = function (object $event) {
            print_r($event);
        };
        $getUsersFromExcel = function ($institution): Models\UserList {
            $users = [];
            if ($xlsx = SimpleXLSX::parse(__DIR__ . "/../../data/".ImportUserFileName::from($institution)->value)) {
                foreach ($xlsx->rows() as $row) {
                    $users[] = ImportUserMapping::fromRow($row);
                }
            } else {
                echo SimpleXLSX::parseError();
            }
            return Models\UserList::new($users);
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
