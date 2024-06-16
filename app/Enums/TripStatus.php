<?php

namespace App\Enums;

enum TripStatus: int
{

    case ASSIGNED = 1;
    case AT_VENDOR = 2;
    case PICKED = 3;
    case DELIVERED = 4;
}
