<?php

namespace App\Http\Services;

use App\Models\Order\Order;
use Illuminate\Support\Facades\Log;
use App\Http\Actions\Order\CreateOrder;

use App\Models\Order\OrderBillingDetail;
use App\Models\Order\OrderShippingDetail;

/**
 * Service to create an order    
 */

class OrderService
{
    public function __construct(private CreateOrder $createOrder) {}

    public function createNewOrder(array $data): Order
    {
        $calculatedOrder = [];

        // Caclulate Order Totals before creating order if line items are avaialble
        if(array_key_exists('order_line_items', $data) && count($data['order_line_items']) > 0) {
            $calculatedOrder = $this->calculateDraftOrder($data['order_line_items'], $data['shipping_handling_total']);
        }

        // Create Order with order items and totals   
        $order = $this->createOrder->execute($data, $calculatedOrder);

        // Assign order id to shipping detail
        if(isset($data['order_shipping_detail_id'])) {
            $this->assignOrderToShippingDetail($data['order_shipping_detail_id'], $order->id);
        }

        // Assign order id to billing detail
        if(isset($data['order_billing_detail_id'])) {
            $this->assignOrderToBillingDetail($data['order_billing_detail_id'], $order->id);
        }

        // Event to send email to customer
        // Observor to send email to admin

        return $order;
    }


    private function assignOrderToShippingDetail($orderShippingDetailId, $orderId)
    {
        try {
            $orderShippingDetail = OrderShippingDetail::find($orderShippingDetailId)->update(['order_id' => $orderId]);
        } catch(\Exception $e) {
            Log::error('Failed to assign order to shipping detail' . $e->getMessage());
        }
    }   

    private function assignOrderToBillingDetail($orderBillingDetailId, $orderId)
    {
        try {
            $orderBillingDetail = OrderBillingDetail::find($orderBillingDetailId)->update(['order_id' => $orderId]);
        } catch(\Exception $e) {
            Log::error('Failed to assign order to billing detail' . $e->getMessage());
        }
    }

    private function calculateDraftOrder(array $lineItems, $shippingHandlingTotal): array
    {
        $discount = 0;
        $subTotal = 0;
        $grandTotal = 0;

        foreach($lineItems as $lineItem) {
            $discount += $lineItem['discount'];
            $subTotal += $lineItem['price'] * $lineItem['quantity'];
        }

        $grandTotal = $subTotal + $shippingHandlingTotal - $discount;

        return [
            'discount_total' => $discount,
            'sub_total' => $subTotal,
            'grand_total' => $grandTotal
        ];
    }
}