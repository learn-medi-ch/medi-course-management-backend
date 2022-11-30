<?php

use Medi\CourseManagementBackend\Core\Domain\Models;

enum ImportUserFileName: string
{
    case BMA = 'Benutzerexport-SSO-BMA.xlsx';
    case OT = 'Benutzerexport-SSO-OT.xlsx';
    case AT = 'Benutzerexport-SSO-AT.xlsx';
    case RS = 'Benutzerexport-SSO-RS.xlsx';
    case AMB = 'Benutzerexport-SSO-AMB.xlsx';
    case DH = 'Benutzerexport-SSO-DH.xlsx';
}