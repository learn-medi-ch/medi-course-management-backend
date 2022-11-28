<?php

namespace Medi\CourseManagementBackend\Adapters\Formatter;

use Medi\CourseManagementBackend\Core\Domain\Models\RefIds;
use Medi\CourseManagementBackend\Core\Domain\Models\RefId;

class RefIdArrayFormatter
{
    public static function new()
    {
        return new self();
    }

    public function format(array $objList) : RefIds
    {

        $refIds = [];
        foreach ($objList as $obj) {
            $refIds[] = RefId::new($obj->ref_id);
        }

        return RefIds::new($refIds);
    }
}