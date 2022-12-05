<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

enum Value: string
{
    case PARAMS = 'params';
    case BoolValue = 'boolValue';
    case USER_IDS = 'userIds';
    case USER_ID = 'userId';
    case REF_IDS = 'refIds';
    case ID = 'id';
    case REF_ID = 'refId';
    case PARENT_REF_ID = 'parentRefId';
    case TITLE = 'title';
    case INSTITUTION = 'institution';
    case OBJECT_TITLE = 'objectTitle';
    case OBJECT_TITLE_LIST = 'objectTitleList';
    case USER = 'user';
    case USER_LIST = 'userList';
    case USER_CUSTOM_FIELD = 'userCustomField';
    case USER_CUSTOM_FIELD_LIST = 'userCustomFieldList';
    case USER_FIELD = 'userField';
    case USER_FIELD_LIST = 'userFieldList';
    case USER_FILTER = 'userFilter';
    case COURSE_ROLE_TYPE = 'courseRoleType';

    public function get(array|int|string|object $payload)
    {
        return match ($this) {
            self::USER_CUSTOM_FIELD_LIST => CustomFields::new($payload),
            self::REF_IDS => RefIds::new($payload),
            self::USER_IDS => UserIds::new($payload),
            self::REF_ID => RefId::new((int)$payload),
            self::PARENT_REF_ID => ParentRefId::new((int)$payload),
            self::TITLE => Title::new((string)$payload),
            self::OBJECT_TITLE => ObjectTitle::new(...$payload),
            self::OBJECT_TITLE_LIST => ObjectTitleList::new($payload),
            self::COURSE_ROLE_TYPE => CourseRoleType::from($payload)
        };
    }


}