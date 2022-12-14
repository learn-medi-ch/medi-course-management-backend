<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\User\UserDiffDto;
use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Core\Domain\ValueObjects;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Adapters\Formatter;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\User\UserDto;
use Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers\UserFieldType;

class UserRepository implements Ports\UserRepository
{
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient)
    {
    }

    public static function new(IliasRestApiClient $iliasRestApiClient)
    {
        return new self($iliasRestApiClient);
    }

    public function getList(Models\UserFilter $filter): array
    {

        //
        /*$users[] = UserDto::new(43);
        $users[] = UserDto::new(5);
        return $users;*/
        //

        $users = $this->iliasRestApiClient->getUsers(
            null,
            null,
            null,
            null,
            false,
            false,
            false,
            true
        );

        $filtered = [];
        if ($filter->hasProperties() === true) {

            //todo
            foreach ($users as $user) {
                if (count($user->user_defined_fields) > 0) {
                    foreach ($user->user_defined_fields as $defined_field) {
                        $satisfiesAllFilter = false;
                        foreach ($filter->getValue() as $keyValue) {
                            if ($defined_field->name === $keyValue->key && $defined_field->value === $keyValue->value) {
                                $satisfiesAllFilter = true;
                            } else {
                                $satisfiesAllFilter = false;
                                break;
                            }
                        }
                        if ($satisfiesAllFilter === true) {
                            $filtered[] = $user;
                        }
                    }
                }
            }
        }

        return $filtered;
    }

    /**
     * @param Models\UserFilter $filter
     * @return Models\UserIds
     */
    public function getUserIds(Models\UserFilter $filter): Models\UserIds
    {
        return Formatter\UserIdsFormatter::new()->format($this->getList($filter));
    }

    public function createOrUpdateUser(ValueObjects\User $user): void
    {
        $users = $this->iliasRestApiClient->getUsers(null, null, null, $user->customFields->get(UserFieldType::ADDRESS_NR->value));
        if (count($users) > 0) {
            foreach ($users as $userDto) {
                $this->updateUser($user);
            }
        } else {
            $this->createUser($user);
        }

    }

    public function updateUser(ValueObjects\User $user): void
    {
        $userDiff = UserAdapter::fromUserValueObject($user)->toUserDiffDto();
        $this->iliasRestApiClient->updateUserByImportId($user->customFields->get(UserFieldType::ADDRESS_NR->value),$userDiff);
    }

    public function createUser(ValueObjects\User $user): void
    {
        $userDiff = UserAdapter::fromUserValueObject($user)->toUserDiffDto();
        $this->iliasRestApiClient->createUser($userDiff);
    }
}