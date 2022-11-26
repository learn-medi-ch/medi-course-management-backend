<?php

namespace Medi\CourseManagementBackend\Core\Ports;
use  Medi\CourseManagementBackend\Core\Domain\Models;
use stdClass;

class EnrollMembersToCourse extends Command
{
    public static function new(Models\ArrayValue $refIds, Models\ArrayValue $userIds) : self
    {
        $obj = new self(Models\Keywords::GET_USER_IDS->value, new stdClass());
        $obj->setProperty($refIds);
        $obj->setProperty($userIds);
        return $obj;
    }
}