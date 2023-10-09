<?php
namespace App\Http\Actions\Order;

use App\Models\Order\OrderShippingBillingDetail;

/**
 * Action to create an order line item    
 */
 class CreateOrderShippingBillingDetail
 {
     public function execute(array $data): OrderShippingBillingDetail
     {  
        $orderShippingBillingDetail = new OrderShippingBillingDetail;
        $orderShippingBillingDetail->contact_name = $data['contact_name'];
        $orderShippingBillingDetail->contact_phone = $data['contact_phone'];
        $orderShippingBillingDetail->contact_alt_no = $data['contact_alt_no'] ?? null;
        $orderShippingBillingDetail->contact_email = $data['contact_email'];
        $orderShippingBillingDetail->type = $data['type'];
        $orderShippingBillingDetail->address_line_1 = $data['address_line_1'];
        $orderShippingBillingDetail->address_line_2 = $data['address_line_2'] ?? null;
        $orderShippingBillingDetail->address_line_3 = $data['address_line_3'] ?? null;
        $orderShippingBillingDetail->town = $data['town'];
        $orderShippingBillingDetail->city = $data['city'];
        $orderShippingBillingDetail->postcode = $data['postcode'];
        $orderShippingBillingDetail->country = $data['country'];
        $orderShippingBillingDetail->is_billing_details_same = $data['is_billing_details_same'];
        $orderShippingBillingDetail->save();

        return $orderShippingBillingDetail;
     }
 }