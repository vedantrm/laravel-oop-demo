<?php

namespace App\Http\Services;

use App\Models\Order\Order;
use App\Models\Order\OrderShippingBillingDetail;
use App\Http\Actions\Order\CreateOrder;

/**
 * Service to create an order, assign order to shipping and billing details and calculate order totals if line items are available
 * Utilizes the CreateOrder action
 * @method createNewOrder
 * @method assignOrderToShippingDetail
 * @method assignOrderToBillingDetail
 * @method calculateDraftOrder
 */

class OrderService
{
    public function __construct(private CreateOrder $createOrder) {}


    /**
     * Create a new order
     * Utilizes the CreateOrder action and calculates order totals if line items are available
     * @param array $data
     * @return Collection<Order>
     */
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
            $this->assignOrderToShippingBillingDetail($data['order_shipping_detail_id'], $order->id);
        }
        // Assign order id to billing detail
        if(isset($data['order_billing_detail_id'])) {
            $this->assignOrderToShippingBillingDetail($data['order_billing_detail_id'], $order->id);
        }
        // Event to send email to customer
        // Observor to send email to admin  

        return $order;
    }


    /**
     * Assign order id to shipping detail
     * @param int $orderShippingBillingDetailId
     * @param int $orderId
     * @return void
     * @log error
     */
    private function assignOrderToShippingBillingDetail($orderShippingBillingDetailId, $orderId)
    {
        OrderShippingBillingDetail::find($orderShippingBillingDetailId)->update(['order_id' => $orderId]);
    }   

    /**
     * Calculate order totals
     * @param array $lineItems
     * @param float $shippingHandlingTotal
     * @return array
     */
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