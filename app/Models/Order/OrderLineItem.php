<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

/**
 * Model to store order line items
 * @uses trait Uuids to generate UUIDs
 * @method belongsTo order
 */
class OrderLineItem extends Model
{
    use Uuids;

    protected $table = 'order_line_item';
    protected $primaryKey = 'id';
    protected $fillable = ['uuid', 'order_id'];
    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order\Order', 'order_id', 'id');
    }

}
