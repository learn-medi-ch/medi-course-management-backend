<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;

use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;

class UserRepository {
    private function __construct(private readonly IliasRestApiClient $iliasRestApiClient) { }

    public static function new(IliasRestApiClient $iliasRestApiClient) {
        return new self($iliasRestApiClient);
    }

    public function byCustomField(string $fieldName, string $fieldValue): array {
        $users =  $this->iliasRestApiClient->getUsers(
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
        foreach($users as $user) {
            if(count($user->user_defined_fields) > 0) {
                foreach($user->user_defined_fields as $defined_field) {
                    if($defined_field->name === $fieldName && $defined_field->value === $fieldValue) {
                        $response[] = $user;
                    }
                }
            }
        }

        return $response;
    }

}