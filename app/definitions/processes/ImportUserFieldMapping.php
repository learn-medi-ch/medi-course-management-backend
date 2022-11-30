<?php

use Medi\CourseManagementBackend\Core\Domain\Models;

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

    public function getField(string $value): Models\ValueInstance|null
    {
        print_r($this);
        return match ($this) {
            self::ADDRESS_NR => Models\UserCustomField::new('Adress-Nr.', $value),
            self::NAME => Models\UserField::new('lastname', $value),
            self::VORNAME => Models\UserField::new('firstname', $value),
            self::E_MAIL_SCHULE => Models\UserField::new('email', $value),
            self::BG_FACHTEAM => Models\UserCustomField::new('BG Fachteam',$value),
            self::BG_ADMIN => Models\UserCustomField::new('BG Admin', $value),
            self::BG_DOZIERENDE => Models\UserCustomField::new('BG Dozierende', $value),
            self::BG_BERUFSBILDENDE => Models\UserCustomField::new('BG Berufsbildende', $value),
            self::BG_STUDIERENDE => Models\UserCustomField::new('BG Studierende', $value),
            self::KLASSE => Models\UserCustomField::new('Klasse', $value),
            self::WBBeginn => null,
            self::WBEnde => null,
        };
    }

}