<?php

namespace Medi\CourseManagementBackend\Core\Ports;

interface Operation
{

}

interface EnrollToCourse
{
    public function handle(int $refId, int $userId) : void;
}