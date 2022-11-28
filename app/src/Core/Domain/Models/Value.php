<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

enum Value: string
{
    case USER_IDS = 'userIds';
    case USER_ID = 'userId';
    case REF_IDS = 'refIds';
    case REF_ID = 'refId';
    case CUSTOM_USER_FIELD = 'customUserField';
    case CUSTOM_USER_FIELDS = 'customUserFields';
    case USER_FILTER = 'userFilter';

    public function get(array|int|string|object $payload)
    {
        return match ($this) {
            self::CUSTOM_USER_FIELDS => CustomUserFields::new($payload),
            self::REF_IDS => RefIds::new($payload),
            self::USER_IDS => UserIds::new($payload),
        };
    }
}