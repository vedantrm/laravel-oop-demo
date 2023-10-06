<?php

namespace App\Models\Order;

use App\Models\Order\OrderLineItem;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order\OrderShippingDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid'];
    protected $guarded = ['id'];

    public function orderLineItem()
    {
        return $this->hasMany(OrderLineItem::class, 'order_id', 'id');
    }

    public function orderShippingDetail()
    {
        return $this->hasOne(OrderShippingDetail::class, 'order_id', 'id');
    }

    public function orderBillingDetail()
    {
        return $this->hasOne(OrderBillingDetail::class, 'order_id', 'id');
    }

}
