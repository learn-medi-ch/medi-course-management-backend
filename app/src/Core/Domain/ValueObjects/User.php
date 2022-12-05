<?php

namespace Medi\CourseManagementBackend\Core\Domain\ValueObjects;

use  Medi\CourseManagementBackend\Core\Domain\Fields;

class User
{
    private function __construct(
        public Fields\FieldGroup $coreFields,
        public Fields\FieldGroup $customFields
    )
    {

    }

    /**
     * @param Fields\FieldGroup $coreFields
     * @param Fields\FieldGroup $customFields
     */
    public static function new(Fields\FieldGroup $coreFields, Fields\FieldGroup $customFields): User
    {

        return new self(
            $coreFields,
            $customFields
        );
    }
}