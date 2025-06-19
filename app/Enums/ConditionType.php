<?php

namespace App\Enums;

enum ConditionType: string
{
    case Attribute = 'attribute';
    case Total = 'total';
    case UserType = 'user_type';
}
