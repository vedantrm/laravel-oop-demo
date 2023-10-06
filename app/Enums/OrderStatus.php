<?php

namespace App\Enums;

enum OrderStatus: string {
    case DRAFT = 'draft';
    case OPEN = 'open';
    case CANCELLED = 'cancelled';
    case ARCHIVED = 'archived';
}
