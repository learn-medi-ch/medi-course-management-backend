<?php

namespace Medi\CourseManagementBackend\Core\Ports\Commands;

use Medi\CourseManagementBackend\Core\Domain\Models\Value;

enum Command: string
{
    case GET_USER_IDS = 'getUserIds';
    case GET_COURSE_IDS = 'getCourseIds';
    case ENROLL_MEMBER_TO_COURSE = 'enrollMemberToCourse';
    case ENROLL_MEMBERS_TO_COURSES = 'enrollMembersToCourses';

    public function get(object $payload = null)
    {
        return match ($this) {
            self::GET_USER_IDS => GetUserIds::new(...$this->getValues((array) $payload)),
            self::GET_COURSE_IDS => GetCourseIds::new(...$this->getValues((array) $payload)),
            self::ENROLL_MEMBERS_TO_COURSES => EnrollMembersToCourses::new(...$this->getValues((array) $payload)),
        };
    }

    private function getValues(array $payloadProperties) : array
    {
        $values = [];
        foreach ($payloadProperties as $name => $value) {
            $values[] = Value::from($name)->get($value);
        }
        return $values;
    }

}