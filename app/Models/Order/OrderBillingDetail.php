<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBillingDetail extends Model
{
    use HasFactory;

    protected $table = 'order_billing_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'order_id'];
    protected $guarded = ['id'];
}
