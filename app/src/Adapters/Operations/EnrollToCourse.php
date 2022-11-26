<?php

namespace Medi\CourseManagementBackend\Adapters\Operations;

use Medi\CourseManagementBackend\Adapters\Repositories\CourseRepository;
use FluxIliasRestApiClient\Adapter\Api\IliasRestApiClient;
use Medi\CourseManagementBackend\Core\Ports\Enroll;

class EnrollToCourse implements Enroll
{

    private function __construct(private CourseRepository $repository)
    {

    }

    public static function new(IliasRestApiClient $iliasRestApiClient)
    {
        return new self(CourseRepository::new($iliasRestApiClient));
    }

    public function handle(int $refId, int $userId) : void
    {
        $this->repository->enrollToCourse($refId, $userId);
    }
}