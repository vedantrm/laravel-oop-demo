<?php

namespace App\Enums;

enum PaymentStatus: string {
    case PAY = 'pay';
    case UNPAID = 'unpaid';
}