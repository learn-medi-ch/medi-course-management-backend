<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models;

class GetUserIds extends CommandInstance
{
    public static function new(
        Models\CustomUserFields $customUserFields
    ) : self {
        return new self(
            Command::GET_USER_IDS,
            [$customUserFields]
        );
    }

    public function getCustomUserFields() : array
    {
        return $this->properties->{Models\Value::CUSTOM_USER_FIELDS->value};
    }
}