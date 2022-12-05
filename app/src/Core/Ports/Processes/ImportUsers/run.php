<?php

use Medi\CourseManagementBackend\Core\Ports\Processes\ImportUsers\ImportUsers;

require_once "../../../../../autoload.php";


ImportUsers::new()->process();