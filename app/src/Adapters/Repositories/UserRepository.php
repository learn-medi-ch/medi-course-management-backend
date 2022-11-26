<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use Medi\CourseManagementBackend\Core\Ports;
use Medi\CourseManagementBackend\Core\Domain\Models;
use Medi\CourseManagementBackend\Adapters\Formatter;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\User\UserDto;

class UserRepository implements Ports\UserRepository
{
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient)
    {
    }

    public static function new(IliasRestApiClient $iliasRestApiClient)
    {
        return new self($iliasRestApiClient);
    }

    public function byCustomField(string $fieldName, string $fieldValue) : array
    {
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

        $response = [];

        //todo
        foreach ($users as $user) {
            if (count($user->user_defined_fields) > 0) {
                foreach ($user->user_defined_fields as $defined_field) {
                    if ($defined_field->name === $fieldName && $defined_field->value === $fieldValue) {
                        $response[] = $user;
                    }
                }
            }
        }

        return $response;
    }

    /**
     * @param Models\UserFilter $filter
     * @return Models\UserIds
     */
    public function getUserIds(Models\UserFilter $filter) : Models\ArrayValue
    {
        /*$users = $this->iliasRestApiClient->getUsers(
            null,
            null,
            null,
            null,
            false,
            false,
            false,
            true
        );*/

        $users[] = UserDto::new();

        $filteredUserIds = [];

        if ($filter->getCustomUserFields()->hasProperties() === true) {

            $filteredUserIds[] = '123';
            return Formatter\RefIdArrayFormatter::new($filteredUserIds);


            //todo
            foreach ($users as $user) {
                if (count($user->user_defined_fields) > 0) {
                    foreach ($user->user_defined_fields as $defined_field) {
                        $satisfiesAllFilter = false;
                        foreach ($filter->getCustomUserFields()->getProperties() as $keyValue) {
                            if ($defined_field->name === $keyValue->key && $defined_field->value === $keyValue->value) {
                                $satisfiesAllFilter = true;
                            } else {
                                $satisfiesAllFilter = false;
                                break;
                            }
                        }
                        if ($satisfiesAllFilter === true) {
                            $filteredUserIds[] = $user->id;
                        }
                    }
                }
            }
        }

        return Models\UserIds::new($filteredUserIds);
    }
}