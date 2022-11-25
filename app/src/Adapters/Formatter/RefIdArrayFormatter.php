<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;

class RefIdArrayFormatter {
    public static function new() {
        return new self();
    }

    public function format(array $objList): array {

        $data =  [];
        foreach($objList as $obj) {
            $data[] = $obj->ref_id;
        }

        return $data;
    }
}