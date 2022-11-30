<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

class User extends ObjectInstance
{

    /**
     * @param UserFieldList $userFieldList
     * @param UserCustomFieldList $userCustomFieldList
     */
    public static function new(UserFieldList $userFieldList, UserCustomFieldList $userCustomFieldList): User
    {

        return new self(Value::USER->value,
            [
                $userFieldList,
                $userCustomFieldList
            ]
        );
    }
}