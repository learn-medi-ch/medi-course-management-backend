<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;


use Medi\CourseManagementBackend\Core\Domain\Fields;

enum ImportUserFieldMapping: int
{
    case ADDRESS_NR = 0;
    case NAME = 1;
    case VORNAME = 2;
    case E_MAIL_SCHULE = 3;
    case BG_FACHTEAM = 4;
    case BG_ADMIN = 5;
    case BG_DOZIERENDE = 6;
    case BG_BERUFSBILDENDE = 7;
    case BG_STUDIERENDE = 8;
    case KLASSE = 9;
    case WBBeginn = 10;
    case WBEnde = 11;

    public function getField(string $value): ?Fields\Field
    {
        print_r($this);
        return match ($this) {
            self::ADDRESS_NR => Fields\Field::new(UserFieldType::ADDRESS_NR->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::NAME => Fields\Field::new(UserFieldType::NAME->value, $value, FieldType::USER_CORE_FIELD->value),
            self::VORNAME => Fields\Field::new(UserFieldType::VORNAME->value, $value, FieldType::USER_CORE_FIELD->value),
            self::E_MAIL_SCHULE => Fields\Field::new(UserFieldType::E_MAIL_SCHULE->value, $value, FieldType::USER_CORE_FIELD->value),
            self::BG_FACHTEAM =>  Fields\Field::new(UserFieldType::BG_FACHTEAM->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::BG_ADMIN => Fields\Field::new(UserFieldType::BG_ADMIN->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::BG_DOZIERENDE => Fields\Field::new(UserFieldType::BG_DOZIERENDE->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::BG_BERUFSBILDENDE => Fields\Field::new(UserFieldType::BG_BERUFSBILDENDE->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::BG_STUDIERENDE => Fields\Field::new(UserFieldType::BG_STUDIERENDE->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::KLASSE => Fields\Field::new(UserFieldType::KLASSE->value, $value, FieldType::USER_CUSTOM_FIELD->value),
            self::WBBeginn => null,
            self::WBEnde => null,
        };
    }

}