<?php
namespace App\Http\Actions\Order;

use App\Models\OrderLineItem;
use Illuminate\Support\Str;
/**
 * Action to create an order line item    
 */

 class CreateOrderLineItem
 {
     public function execute(array $orderLineItemData): OrderLineItem
     {
         $orderLineItem = OrderLineItem::create([
             'uuid' => Str::orderedUuid(),
             'order_id' => $orderLineItemData['order_id'] ?? null,
             'product_id' => $orderLineItemData['product_id'],
             'quantity' => $orderLineItemData['quantity'],
             'price' => $orderLineItemData['price'],
             'discount' => $orderLineItemData['discount'],
             'total' => $orderLineItemData['total']
         ]);
         
         return $orderLineItem;
     }
 }