<?php

namespace App\Enums;

enum DiscountType: int
{
    case Percentage = 1;
    case Fixed = 2;
}
