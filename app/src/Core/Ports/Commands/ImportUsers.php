<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models;

class ImportUsers extends CommandInstance
{
    public static function new(
        Models\UserList $userList
    ) : self {
        return new self(
            Command::IMPORT_USERS,
            [$userList]
        );
    }

    public function getUsers(): array {
        return $this->value->{Models\Value::USER_LIST->value};
    }

}