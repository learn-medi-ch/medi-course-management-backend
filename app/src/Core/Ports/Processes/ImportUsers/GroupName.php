<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;


enum GroupName: string
{
    case USER_CORE_FIELDS = "userCoreFields";
    case USER_CUSTOM_FIELDS = "userCustomFields";
}