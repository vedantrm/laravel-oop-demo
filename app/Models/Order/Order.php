<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

/**
 * Model to store order details
 * @uses trait Uuids to generate UUIDs
 * @method hasMany orderLineItems
 * @method hasOne orderShippingDetail
 */
class Order extends Model
{
    use Uuids;
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'status', 'payment_status', 'customer_note', 'contact_name', 'contact_email', 'sub_total', 'discount_total', 'shipping_handling_total', 'grand_total'];
    protected $guarded = ['id'];

    public function orderLineItems()
    {
        return $this->hasMany('App\Models\Order\OrderLineItem', 'order_id', 'id');
    }

    public function orderShippingBillingDetail()
    {
        return $this->hasMany('App\Models\Order\OrderShippingBillingDetail', 'order_id', 'id');
    }

}
