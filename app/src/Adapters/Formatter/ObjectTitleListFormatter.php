<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;

use Medi\CourseManagementBackend\Core\Domain\Models\ObjectTitle;
use Medi\CourseManagementBackend\Core\Domain\Models\ObjectTitleList;
use Medi\CourseManagementBackend\Core\Domain\Models\RefId;
use Medi\CourseManagementBackend\Core\Domain\Models\Title;

class ObjectTitleListFormatter
{
    public static function new()
    {
        return new self();
    }

    public function format(array $objList) : ObjectTitleList
    {

        $objectTitles = [];
        foreach ($objList as $obj) {
            $objectTitles[] = ObjectTitle::new(RefId::new($obj->ref_id), Title::new($obj->title));
        }

        return ObjectTitleList::new($objectTitles);
    }
}