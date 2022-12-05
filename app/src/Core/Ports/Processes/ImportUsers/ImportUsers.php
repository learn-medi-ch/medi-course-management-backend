<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;

require_once __DIR__ . '/../../../../../libs/SimpleXLSX.php';
require_once __DIR__ . '/ImportUserFieldMapping.php';
require_once __DIR__ . '/ImportUserMapping.php';

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Adapters\Api\Api;
use Medi\CourseManagementBackend\Adapters\Api\Process;
use Medi\CourseManagementBackend\Adapters\Repositories\CourseRepository;
use Medi\CourseManagementBackend\Adapters\Repositories\UserRepository;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Ports;
use Shuchkin\SimpleXLSX;

class ImportUsers
{

    private function __construct(
        private Api $api
    )
    {

    }

    public static function new()
    {
        return new self(Api::new());
    }

    //Models\Institution $institution
    public function process()
    {
        $users= $this->getUsersFromExcel('BMA');
        foreach($users as $user) {
            UserRepository::new(  IliasRestApiClient::new())->createOrUpdateUser($user);
        }

        /*$this->api->process(
            Process::new([
                    Ports\Commands\ImportUsers::new(
                        $getUsersFromExcel($institution)
                    )
                ]
            ),
            $publish
        );*/

        /*$publish = function (object $event) {
            print_r($event);
        };
        $*/


        /*$api = Api::new();
        $api->process(
            Process::new([
                    Ports\Commands\ImportUsers::new(
                        $getUsersFromExcel($institution)
                    )
                ]
            ),
            $publish
        );*/
    }

    private function getUsersFromExcel($institution)
    {
        $users = [];
        if ($xlsx = SimpleXLSX::parse(__DIR__ . "/../../../../../data/" . ImportUserFileName::BMA->value)) {
            foreach ($xlsx->rows() as $row) {
                $users[] = ImportUserMapping::fromRow($row);
            }
        } else {
            echo SimpleXLSX::parseError();
        }
        return $users;
    }
}
