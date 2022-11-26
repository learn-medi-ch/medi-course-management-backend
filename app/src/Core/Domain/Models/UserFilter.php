<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models;

use stdClass;

class UserFilter extends KeyValueObject
{

    public static function new(): self {
        return new self(Keywords::USER_FILTER->value, new stdClass());
    }

    public function appendCustomUserFieldsFilter(KeyValue $keyValue)
    {
        $objectValue = ObjectValue::new(Keywords::CUSTOM_USER_FIELDS->value, $keyValue);
        $this->setProperty($objectValue);
        return $this;
    }

    public function getCustomUserFields(): KeyValueObject {
        return $this->properties->{Keywords::CUSTOM_USER_FIELDS->value};
    }
}