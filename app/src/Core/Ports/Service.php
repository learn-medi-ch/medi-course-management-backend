<?php

namespace Medi\CourseManagementBackend\Core\Ports;

class Service
{

    private function __construct()
    {

    }

    public static function new()
    {
        return new self();
    }

    public function publishData(array|object $data, Publisher $publisher)
    {
        $publisher->handle(json_encode($data, JSON_UNESCAPED_SLASHES));
    }

    public function enrollMembers(array $userIds, array $courseRefIds, Enroll $enroll, Publisher $publisher)
    {
        foreach($courseRefIds as $courseRefId) {
            foreach($userIds as $userId) {
                $enroll->handle($courseRefId, $userId);
            }
        }
        $publisher->handle(json_encode([$userIds, $courseRefIds], JSON_UNESCAPED_SLASHES));
    }
}