<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use Medi\CourseManagementBackend\Core\Domain\Models\KeyValue;
use Medi\CourseManagementBackend\Core\Domain\Models\ArrayValue;

class Service
{
    private function __construct(
        private UserRepository $userRepository,
        private CourseRepository $courseRepository
    )
    {

    }

    public static function new(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        return new self($userRepository, $courseRepository);
    }

    public function publishData(array|object $data, Publisher $publisher)
    {
        $publisher->handle(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function getUserIds(GetUserIds $command): KeyValue {
        return $this->userRepository->getUserIds($command->getUserFilter());
    }

    public function getCourseIds(GetCourseIds $command): ArrayValue {
        return $this->courseRepository->getRefIds();
    }

    public function enrollMembersToCourses(EnrollMembersToCourse $payload)
    {
        print_r($payload);
        /*
        foreach($payload->refIds as $refId) {
            foreach($payload->userIds as $userId) {
                $this->enrollMember(EnrollMemberPayload::new($refId, $userId));
            }
        }*/

    }

    public function enrollMember(EnrollMemberPayload $payload)
    {
        print_r($payload);
    }
}