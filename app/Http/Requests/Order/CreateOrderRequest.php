<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Order\OrderShippingBillingDetail;
use App\Traits\ApiResponses;

class CreateOrderRequest extends FormRequest
{
    use ApiResponses;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        return [
            'status' => ['present', 'required', new Enum(OrderStatus::class)],
            'payment_status' => ['present', 'required', new Enum(PaymentStatus::class)],
            'contact_name' => ['sometimes', 'required', 'string'],
            'contact_email' => ['sometimes', 'required', 'email'],
            'customer_note' => ['sometimes', 'required', 'string'],
            'shipping_handling_total' => ['present', 'required', 'numeric'],
            'order_shipping_detail_id' => ['sometimes', 'required', 'numeric', 'exists:order_shipping_billing_detail,id', function($attribute, $value, $fail) {
                $orderShippingBillingDetail = OrderShippingBillingDetail::find($value);
                if($orderShippingBillingDetail->order_id) {
                    $fail('Order Shipping Detail has already been assigned to an order');
                }
                if($orderShippingBillingDetail->type != 'shipping') {
                    $fail('Order Shipping Detail is not a shipping detail');
                }
            }],
            'order_billing_detail_id' => ['sometimes','required', 'numeric', 'exists:order_shipping_billing_detail,id', function($attribute, $value, $fail) {
                $orderShippingBillingDetail = OrderShippingBillingDetail::find($value);
                if($orderShippingBillingDetail->order_id) {
                    $fail('Order Billing Detail has already been assigned to an order');
                }
                if($orderShippingBillingDetail->type != 'billing') {
                    $fail('Order Billing Detail is not a billing detail');
                }
            }],
            'order_line_items' => ['sometimes','required', 'array'],
            'order_line_items.*.name' => ['sometimes', 'required', 'string'],
            'order_line_items.*.quantity' => ['sometimes', 'required', 'numeric','gt:0'],
            'order_line_items.*.sku' => ['sometimes', 'required', 'string'],
            'order_line_items.*.price' => ['sometimes', 'required', 'numeric','gt:0'],
            'order_line_items.*.discount' => ['sometimes', 'required', 'numeric'],
            'order_line_items.*.total' => ['sometimes', 'required', 'numeric','gt:0'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    { 
        
        $response = $this->validatorErrorResponse(
            200,
            $validator->errors()
        );           
        
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
