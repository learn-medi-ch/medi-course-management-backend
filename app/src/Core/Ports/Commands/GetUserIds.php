<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models;

class GetUserIds extends CommandInstance
{
    public static function new(
        Models\UserCustomFieldList $customUserFields
    ) : self {
        return new self(
            Command::GET_USER_IDS,
            [$customUserFields]
        );
    }

    public function getCustomUserFields() : array
    {
        return $this->value->{Models\Value::USER_CUSTOM_FIELD_LIST->value};
    }
}