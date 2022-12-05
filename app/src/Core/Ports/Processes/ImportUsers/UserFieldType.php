<?php

namespace Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers;


use Medi\CourseManagementBackend\Core\Domain\Fields;

enum UserFieldType: string
{
    case IMPORT_ID = 'import_id';
    case LOGIN = 'login';
    case ADDRESS_NR = 'Adress-Nr.';
    case MATRICULATION_NUMBER = 'matriculation_number';
    case NAME = 'last_name';
    case VORNAME = 'first_name';
    case E_MAIL_SCHULE = 'email';
    case BG_FACHTEAM = 'BG Fachteam';
    case BG_ADMIN = 'BG Admin';
    case BG_DOZIERENDE = 'BG Dozierende';
    case BG_BERUFSBILDENDE = 'BG Berufsbildende';
    case BG_STUDIERENDE = 'BG Studierende';
    case KLASSE = 'Klasse';
    CASE USER_DEFINED_FIELDS = 'user_defined_fields';
}