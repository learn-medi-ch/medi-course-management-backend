<?php

namespace Medi\CourseManagementBackend\Core\Domain\Events;

use Medi\CourseManagementBackend\Core\Domain\Models\Value;
use Medi\CourseManagementBackend\Core\Ports\Commands\EnrollMembersToCourses;

enum Event: string
{
    case MEMBERS_ENROLLED_TO_COURSES = 'MembersEnrolledToCourses';
    case MEMBER_ENROLLED_TO_COURSE = 'MembersEnrolledToCourse';

    public function get(object $payload = null)
    {
        return match ($this) {
            self::MEMBERS_ENROLLED_TO_COURSES => EnrollMembersToCourses::new(...$this->getValues((array) $payload)),
            self::MEMBER_ENROLLED_TO_COURSE => GetCourseIds::new(...$this->getValues((array) $payload)),
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