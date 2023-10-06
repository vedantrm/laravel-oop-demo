<?php
namespace App\Http\Actions\Order;

use App\Models\Order\Order;
use Illuminate\Support\Str;
/**
 * Action to create an order    
 */


class CreateOrder   
{

    public function __construct(private CreateOrderLineItem $createOrderLineItem){}

    public function execute(array $data, array $calculatedOrder = []): Order
    {
        $order = Order::create([
            'uuid' => Str::orderedUuid(),
            'status' => $data['status'],
            'payment_status' => $data['payment_status'],
            'contact_name' => $data['contact_name'] ?? null,
            'contact_email' => $data['contact_email'] ?? null,
            'customer_note' => $data['customer_note'] ?? null,
            'shipping_handling_total' => $data['shipping_handling_total'] ?? 0,
            'discount_total' => $calculatedOrder['discount_total'] ?? 0,
            'sub_total' => $calculatedOrder['sub_total'] ?? 0,
            'grand_total' => $calculatedOrder['grand_total'] ?? 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if(array_key_exists('order_line_items', $data) && count($data['order_line_items']) > 0) {
            foreach($data['order_line_items'] as $orderLineItem) {
                $lineItem =  $this->createOrderLineItem->execute($orderLineItem);
                $order->orderLineItems()->attach($lineItem);
            }
        }

        return $order;
    }
}