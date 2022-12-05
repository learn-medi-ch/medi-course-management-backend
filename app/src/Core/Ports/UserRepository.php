<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Core\Domain\ValueObjects;

interface UserRepository
{
    public function getUserIds(
        Models\UserFilter $filter
    ) : Models\UserIds;

    /**
     * @param  ValueObjects\User $user
     * @return void
     */
    public function createOrUpdateUser(
        ValueObjects\User  $user
    ) : void;
}