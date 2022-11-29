<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

enum Value: string
{
    case USER_IDS = 'userIds';
    case USER_ID = 'userId';
    case REF_IDS = 'refIds';
    case REF_ID = 'refId';
    case PARENT_REF_ID = 'parentRefId';
    case TITLE = 'title';
    case OBJECT_TITLE = 'object_title';
    case OBJECT_TITLES = 'object_titles';
    case CUSTOM_USER_FIELD = 'customUserField';
    case CUSTOM_USER_FIELDS = 'customUserFields';
    case USER_FILTER = 'userFilter';

    public function get(array|int|string|object $payload)
    {
        return match ($this) {
            self::CUSTOM_USER_FIELDS => CustomUserFields::new($payload),
            self::REF_IDS => RefIds::new($payload),
            self::USER_IDS => UserIds::new($payload),
            self::REF_ID => RefId::new((int)$payload),
            self::PARENT_REF_ID => ParentRefId::new((int)$payload),
            self::TITLE => Title::new((string)$payload),
            self::OBJECT_TITLE => ObjectTitle::new(...$payload),
            self::OBJECT_TITLES => ObjectTitleList::new($payload),
        };
    }
}