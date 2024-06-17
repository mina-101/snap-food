<?php

namespace App\Enums;

enum DelayStatus: int
{
    case DELAYED = 1;
    case CHECK = 2;
    case TRACK = 3;
}
