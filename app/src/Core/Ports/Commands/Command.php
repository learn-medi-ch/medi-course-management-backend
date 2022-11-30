<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models\Value;

enum Command: string
{
    case GET_USER_IDS = 'getUserIds';
    case IMPORT_USERS = 'importUsers';
    case GET_COURSE_IDS = 'getCourseIds';
    case GET_COURSE_TITLES = 'getCourseTitles';
    case GET_CATEGORY_TITLES = 'getCategoryTitles';
    case ENROLL_MEMBER_TO_COURSE = 'enrollMemberToCourse';
    case ENROLL_MEMBERS_TO_COURSES = 'enrollMembersToCourses';

    public function get(object $payload = null)
    {
        return match ($this) {
            self::GET_USER_IDS => GetUserIds::new(...$this->getValues((array)$payload)),
            self::IMPORT_USERS => ImportUsers::new(),
            self::GET_COURSE_IDS => GetCourseIds::new($payload),
            self::GET_COURSE_TITLES => GetCourseTitles::new($payload),
            self::GET_CATEGORY_TITLES => GetCategoryTitles::new($payload),
            self::ENROLL_MEMBERS_TO_COURSES => EnrollMembersToCourses::new(...$this->getValues((array)$payload)),
        };
    }

    private function getValues(array $payloadProperties): array
    {
        $values = [];
        foreach ($payloadProperties as $name => $value) {
            $values[] = Value::from($name)->get($value);
        }
        return $values;
    }

}