<?php

namespace Medi\CourseManagementBackend\Adapters\Repositories;
use FluxIliasRestApiClient\Libs\FluxIliasBaseApi\Adapter\User\UserDiffDto;
use  Medi\CourseManagementBackend\Core\Domain\ValueObjects\User;
use stdClass;


class UserAdapter {

    private function __construct(private User $user) {

    }

    public static function fromUserValueObject(User $user) {
        return new self($user);
    }

    public function toUserDiffDto(): UserDiffDto {
        $user = new StdClass();
        foreach($this->user->customFields->fields as $fieldName => $fieldValue) {
            $user->{$key} = $fieldValue;
        }

        return UserDiffDto::newFromObject($user);
    }
}