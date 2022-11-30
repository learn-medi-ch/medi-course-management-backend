<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use Medi\CourseManagementBackend\Core\Domain\Models;

interface UserRepository
{
    public function getUserIds(
        Models\UserFilter $filter
    ) : Models\UserIds;

    /**
     * @param  Models\User[] $users
     * @return void
     */
    public function createOrUpdateUser(
        Models\User $user
    ) : void;
}