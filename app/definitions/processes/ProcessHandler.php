<?php
require_once __DIR__ . '/../../autoload.php';

use Medi\CourseManagementBackend\Core\Domain\Models;


require_once __DIR__ . '/ImportUsers/ImportUsers.php';
require __DIR__ . '/../../libs/SimpleXLSX.php';


enum ProcessHandler: string
{
    case IMPORT_USERS = 'ImportUsers';

    public function process(Models\Params $params)
    {
        match ($this) {
            self::IMPORT_USERS => ImportUsers::process($params->{Models\Value::INSTITUTION->value})
        };
    }
}