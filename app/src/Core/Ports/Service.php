<?php

namespace Medi\CourseManagementBackend\Core\Ports;

use Medi\CourseManagementBackend\Core\Domain;

class Service
{
    private function __construct(
        private UserRepository     $userRepository,
        private CourseRepository   $courseRepository,
        private CategoryRepository $categoryRepository
    )
    {

    }

    public static function new(UserRepository $userRepository, CourseRepository $courseRepository, CategoryRepository $categoryRepository)
    {
        return new self($userRepository, $courseRepository, $categoryRepository);
    }

    public function publishData(array|object $data, Publisher $publisher)
    {
        $publisher->handle(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function getUserIds(Commands\GetUserIds $command): Domain\Models\UserIds
    {
        return $this->userRepository->getUserIds(Domain\Models\UserFilter::new($command->getCustomUserFields()));
    }

    public function importUsers(Commands\ImportUsers $command): Domain\Models\BoolValue
    {
        foreach ($command->getUsers() as $user) {
            $this->userRepository->createOrUpdateUser($user);
        }

        return Domain\Models\BoolValue::new(true);
    }

    public function getCourseIds(Commands\GetCourseIds $command): Domain\Models\RefIds
    {
        return $this->courseRepository->getRefIds($command->getParentRefId());
    }

    public function getCourseTitles(Commands\GetCourseTitles $command): Domain\Models\ObjectTitleList
    {
        return $this->courseRepository->getTitles($command->getParentRefId());
    }

    public function getCategoryTitles(Commands\GetCategoryTitles $command): Domain\Models\ObjectTitleList
    {
        return $this->categoryRepository->getTitles($command->getParentRefId());
    }

    /**
     * @throws \Exception
     */
    public function enrollMembersToCourses(Commands\EnrollUsersToCourse $command): object
    {
        foreach ($command->getRefIds() as $refId) {
            foreach ($command->getUserIds() as $userId) {
                $this->enrollMemberToCourse(Commands\EnrollUserToCourseAsMember::new(
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

    public function enrollMemberToCourse(Commands\EnrollUserToCourseAsMember $command): object
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