<?php
namespace App\Http\Actions\Order;

use App\Models\Order\Order;
use App\Http\Actions\Order\CreateOrderLineItem;

/**
 * Action to create an order
 * Utilizes the CreateOrderLineItem action
 * @method execute
 */ 
class CreateOrder   
{
    public function __construct(private CreateOrderLineItem $createOrderLineItem){}

    /**
     * Create a new order and line items if available
     * @param array $data
     * @param array $calculatedOrder
     * @return Order
     */
    public function execute(array $data, array $calculatedOrder): Order
    {   
        $order = new Order;
        $order->status = $data['status'];
        $order->payment_status = $data['payment_status'];
        $order->contact_name = $data['contact_name'] ?? null;
        $order->contact_email = $data['contact_email'] ?? null;
        $order->customer_note = $data['customer_note'] ?? null;
        $order->shipping_handling_total = $data['shipping_handling_total'] ?? 0;
        $order->discount_total = $calculatedOrder['discount_total'] ?? 0;
        $order->sub_total = $calculatedOrder['sub_total'] ?? 0;
        $order->grand_total = $calculatedOrder['grand_total'] ?? 0;
        $order->save();

        if(array_key_exists('order_line_items', $data) && count($data['order_line_items']) > 0) {
            foreach($data['order_line_items'] as $orderLineItem) {
                $lineItem =  $this->createOrderLineItem->execute($orderLineItem);
                $order->orderLineItems()->save($lineItem);
            }
        }

        return $order;
    }
}