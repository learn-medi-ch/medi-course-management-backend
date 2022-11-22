<?php

namespace Medi\CourseManagementBackend\Adapters\ProjectionTypes;

class KeyValueList {
    public static function new() {
        return new self();
    }

    public function project(string $jsonData, callable $publish) {
        echo $jsonData;
        $objList = json_decode($jsonData);

        $data = [];
        foreach($objList as $obj) {
            $data[] = '{ id: "refId/'.$obj->refId.'", title: "'.$obj->title.'" }';
        }

        $publish(json_encode($data, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES));
    }
}