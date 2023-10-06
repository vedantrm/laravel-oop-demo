<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLineItem extends Model
{
    use HasFactory;

    protected $table = 'order_line_item';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'order_id'];
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id', 'order_id');
    }

}
