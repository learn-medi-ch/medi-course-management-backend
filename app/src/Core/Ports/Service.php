<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use Medi\CourseManagementBackend\Core\Domain;

class Service
{
    private function __construct(
        private UserRepository $userRepository,
        private CourseRepository $courseRepository
    ) {

    }

    public static function new(UserRepository $userRepository, CourseRepository $courseRepository)
    {
        return new self($userRepository, $courseRepository);
    }

    public function publishData(array|object $data, Publisher $publisher)
    {
        $publisher->handle(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function getUserIds(Commands\GetUserIds $command) : Domain\Models\UserIds
    {
        return $this->userRepository->getUserIds(Domain\Models\UserFilter::new($command->getCustomUserFields()));
    }

    public function getCourseIds(Commands\GetCourseIds $command) : Domain\Models\RefIds
    {
        return $this->courseRepository->getRefIds();
    }

    /**
     * @throws \Exception
     */
    public function enrollMembersToCourses(Commands\EnrollMembersToCourses $command) : object
    {
        foreach ($command->getRefIds() as $refId) {
            foreach ($command->getUserIds() as $userId) {
                $this->enrollMemberToCourse(Commands\EnrollMemberToCourse::new(
                    $refId,
                    $userId
                )
                );
            }
        }

        return Domain\Events\MembersEnrolledToCourses::new(
            Domain\Models\RefIds::new($command->getRefIds()),
            Domain\Models\UserIds::new($command->getUserIds())
        );
    }

    public function enrollMemberToCourse(Commands\EnrollMemberToCourse $command) : object
    {
        print_r($command);

        return Domain\Events\MemberEnrolledToCourse::new(
            Domain\Models\RefId::new(
                $command->getRefId()
            ),
            Domain\Models\UserId::new(
                $command->getUserId()
            )
        );
    }
}