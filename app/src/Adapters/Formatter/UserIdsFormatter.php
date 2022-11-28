<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;


use Medi\CourseManagementBackend\Core\Domain\Models\UserIds;
use Medi\CourseManagementBackend\Core\Domain\Models\UserId;

class UserIdsFormatter
{
    public static function new()
    {
        return new self();
    }

    public function format(array $objList) : UserIds
    {

        $userIds = [];
        foreach ($objList as $obj) {
            $userIds[] = UserId::new($obj->id);
        }

        return UserIds::new($userIds);
    }
}