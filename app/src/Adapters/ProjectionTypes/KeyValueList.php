<?php

namespace Medi\CourseManagementBackend\Adapters\ProjectionTypes;

class KeyValueList {
    public static function new() {
        return new self();
    }

    public function project(string $jsonData, callable $publish) {
        $publish($jsonData);
    }
}