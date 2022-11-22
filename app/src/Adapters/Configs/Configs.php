<?php

namespace Medi\CourseManagementBackend\Adapters\Configs;

use Medi\CourseManagementBackend\Adapters;
use mysql_xdevapi\Exception;

class Configs
{

    public array $contexts;
    private array $projectTo;

    private function __construct()
    {
        $this->contexts['courseList'] = function ($parentRefId): string {
            return Adapters\Repositories\CourseRepository::new()->getList($parentRefId);
        };

        $this->projectTo['keyValueList'] = function (callable $publish): callable {
            return function (string $jsonData) use ($publish) {
                Adapters\ProjectionTypes\KeyValueList::new()->project($jsonData, $publish);
            };
        };
    }

    public static function new()
    {
        return new self();
    }

    public function projectTo(string $projectionType, callable $publish): callable
    {
        if (key_exists($projectionType, $this->projectTo) === false) {
            return function () {
                //throw new Exception('invalid path');
            };
        }
        return $this->projectTo[$projectionType]($publish);
    }

    public function data(string $contextType, string $parentIdOrId): string
    {
        if (key_exists($contextType, $this->contexts) === false) {
            return "{}";
        }
        return $this->contexts[$contextType]($parentIdOrId);
    }

    private function courseList(int $parentRefId, callable $projectTo)
    {

    }


}