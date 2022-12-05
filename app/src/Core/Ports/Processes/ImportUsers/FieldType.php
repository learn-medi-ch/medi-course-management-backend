<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;

enum FieldType: string
{
    case USER_CORE_FIELD = "userCoreField";
    case USER_CUSTOM_FIELD = "userCustomField";
}