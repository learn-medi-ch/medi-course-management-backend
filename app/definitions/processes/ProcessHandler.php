<?php
require_once __DIR__ . '/../../autoload.php';

use Medi\CourseManagementBackend\Core\Domain\Models;


require_once __DIR__ . '/ImportUsers/ImportUsers.php';
require __DIR__ . '/../../libs/SimpleXLSX.php';


enum ProcessHandler: string
{
    case IMPORT_USERS = 'ImportUsers';

    //Models\Params $params
    public function process()
    {
        match ($this) {
            //$params->{Models\Value::INSTITUTION->value}
            self::IMPORT_USERS => ImportUsers::process()
        };
    }
}