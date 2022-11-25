<?php

namespace Medi\CourseManagementBackend\Adapters\ProjectionTypes;

use stdClass;

class KeyValueList {
    public static function new() {
        return new self();
    }

    public function project(array $objList, callable $publish) {

        $data =  new StdClass();
        foreach($objList as $obj) {
            $object = new StdClass();
            $object->id = "refId/".$obj->ref_id;
            $object->title = $obj->title;
            $data->{"ref_id_".$obj->ref_id} = $object;
        }

        $publish(json_encode($data, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
    }
}