<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;
use Medi\CourseManagementBackend\Core\Domain\Models\ArrayValue;
use Medi\CourseManagementBackend\Core\Domain\Models\Keywords;

class RefIdArrayFormatter {
    public static function new() {
        return new self();
    }

    public function format(array $objList): ArrayValue {

        $refIds =  [];
        foreach($objList as $obj) {
            $refIds[] = $obj->ref_id;
        }

        return ArrayValue::new(Keywords::REF_IDS->value, $refIds);
    }
}