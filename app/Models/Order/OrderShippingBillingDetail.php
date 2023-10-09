<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

/**
 * Model to store order shipping details
 */
class OrderShippingBillingDetail extends Model
{
    use Uuids;

    protected $table = 'order_shipping_billing_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'order_id', 'contact_name', 'contact_phone', 'contact_alt_no', 'contact_email','type', 'address_line_1', 'address_line_2', 'address_line_3', 'town', 'city', 'postcode', 'country', 'is_billing_details_same'];
    protected $guarded = ['id'];
    
    public function order()
    {
        return $this->belongsTo('App\Models\Order\Order', 'order_id', 'id');
    }
}
