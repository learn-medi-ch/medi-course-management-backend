<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;

use stdClass;

class KeyValueListFormatter {
    public static function new() {
        return new self();
    }

    public function format(array $objList): object {

        $data =  new StdClass();
        foreach($objList as $obj) {
            $object = new StdClass();
            $object->id = "refId/".$obj->ref_id;
            $object->title = $obj->title;
            $data->{"ref_id_".$obj->ref_id} = $object;
        }

        return $data;
    }
}