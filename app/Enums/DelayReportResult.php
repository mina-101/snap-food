<?php

namespace App\Enums;

enum DelayReportResult: int
{
    case NEW_DELIVERY_TIME = 1;
    case DELAYED = 2;
}
