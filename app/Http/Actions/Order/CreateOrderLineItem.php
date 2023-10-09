<?php
namespace App\Http\Actions\Order;

use App\Models\Order\OrderLineItem;

/**
 * Action to create an order line item    
 */

 class CreateOrderLineItem
 {
     public function execute(array $data): OrderLineItem
     {  
        $orderLineItem = new OrderLineItem;
        $orderLineItem->name = $data['name'];
        $orderLineItem->quantity = $data['quantity'];
        $orderLineItem->price = $data['price'];
        $orderLineItem->discount = $data['discount'];
        $orderLineItem->total = $data['total'];
        $orderLineItem->save();
         
        return $orderLineItem;
     }
 }