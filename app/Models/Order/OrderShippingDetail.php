<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShippingDetail extends Model
{
    use HasFactory;

    protected $table = 'order_shipping_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'order_id'];
    protected $guarded = ['id'];
}
