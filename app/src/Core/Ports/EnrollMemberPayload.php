<?php

namespace Medi\CourseManagementBackend\Core\Ports;

class EnrollMemberPayload
{

    private function __construct(
        public int $refId,
        public int $userId
    ) {

    }

    public static function new(int $refId, int $userId) : self
    {
        return new self($refId, $userId);
    }
}