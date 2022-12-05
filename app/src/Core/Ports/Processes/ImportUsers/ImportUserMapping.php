<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;

use Medi\CourseManagementBackend\Core\Domain\Fields;
use Medi\CourseManagementBackend\Core\Domain\ValueObjects;


class ImportUserMapping
{

    public static function fromRow(array $row): ValueObjects\User
    {
        $coreFields = [];
        $customFields = [];

        foreach ($row as $columnKey => $column) {
            $field = ImportUserFieldMapping::from($columnKey)->getField($column);
            if ($field === null) {
                continue;
            }

            match ($field->fieldType) {
                FieldType::USER_CORE_FIELD->value => $coreFields[] = $field,
                FieldType::USER_CUSTOM_FIELD->value => $customFields[] = $field,
            };
        }

        return ValueObjects\User::new(
            Fields\FieldGroup::new(GroupName::USER_CORE_FIELDS->value, $coreFields),
            Fields\FieldGroup::new(GroupName::USER_CORE_FIELDS->value, $customFields),
        );
    }
}