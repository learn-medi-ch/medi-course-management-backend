<?php

namespace Medi\CourseManagementBackend\Core\Domain\Models\Values;

enum ValueType : string
{
    case STRING = 'string';
    case ARRAY = 'array';
    case INT = 'int';
    case OBJECT = 'object';
}