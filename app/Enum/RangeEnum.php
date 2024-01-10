<?php

namespace App\Enum;

enum RangeEnum: int
{
    case DAY = 1;
    case WEEK = 2;
    case MONTH = 3;
    case ALL = 4;
}
