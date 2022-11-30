<?php

use Medi\CourseManagementBackend\Core\Domain\Models;


class ImportUserMapping
{

    public static function fromRow(array $row): Models\User
    {
        $userFields = [];
        $userCustomFields = [];

        foreach ($row as $columnKey => $column) {
            $field = ImportUserFieldMapping::from($columnKey)->getField($column);

            if($field === null) {
                continue;
            }

            if($field instanceof Models\UserField) {
                $userFields[] = $field;
            }

            if($field instanceof Models\UserCustomField) {
                $userCustomFields[] = $field;
            }


        }

        return Models\User::new(
            Models\UserFieldList::new($userFields),
            Models\UserCustomFieldList::new($userCustomFields)
        );
    }
}