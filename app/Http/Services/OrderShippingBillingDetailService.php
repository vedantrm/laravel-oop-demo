<?php

namespace App\Http\Services;

use App\Models\Order\OrderShippingBillingDetail;
use App\Http\Actions\Order\CreateOrderShippingBillingDetail;

/**
 * Service to create an order shipping and billing detail
 * Utilizes the CreateOrderShippingBillingDetail action
 * @method createNewOrderShippingBillingDetail
 */
class OrderShippingBillingDetailService
{
    public function __construct(private CreateOrderShippingBillingDetail $createOrderShippingBillingDetail) {}

    /**
     * Create a new order shipping and billing detail
     * Utilizes the CreateOrderShippingBillingDetail action
     * @param array $data
     * @return OrderShippingBillingDetail
     */
    public function createNewOrderShippingBillingDetail(array $data): OrderShippingBillingDetail
    {
        $orderShippingBillingDetail = $this->createOrderShippingBillingDetail->execute($data);
        return $orderShippingBillingDetail;
    }
}
