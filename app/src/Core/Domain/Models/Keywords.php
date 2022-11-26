<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

enum Keywords: string
{
    case USER_IDS = 'userIds';
    case REF_IDS = 'refIds';
    case USER_FILTER = 'userFilter';
    case CUSTOM_USER_FIELDS = 'customUserFields';
    case GET_USER_IDS = 'getUserIds';
    case GET_COURSE_IDS = 'getCourseIds';
    case ENROLL_MEMBERS_TO_COURSES = 'enrollMembersToCourses';
}