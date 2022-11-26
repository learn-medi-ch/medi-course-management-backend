<?php

namespace Medi\CourseManagementBackend\Core\Ports;
use  Medi\CourseManagementBackend\Core\Domain\Models;

use stdClass;

class GetUserIds extends Command
{
    public static function new(Models\UserFilter $userFilter) : self
    {
        $obj = new self(Models\Keywords::GET_USER_IDS->value, new stdClass());
        $obj->setProperty($userFilter);
        return $obj;
    }

    public function getUserFilter()
    {
        return $this->properties->{Models\Keywords::USER_FILTER->value};
    }
}