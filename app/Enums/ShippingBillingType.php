<?php

namespace App\Enums;

enum ShippingBillingType: string {
    case SHIPPING = 'shipping';
    case BILLING = 'billing';
}