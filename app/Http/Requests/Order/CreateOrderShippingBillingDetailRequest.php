<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderShippingBillingDetailRequest extends FormRequest
{
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
            'shipping_detail' => ['present', 'required', 'array'], 
            'shipping_detail.*.contact_name' => ['present', 'required', 'string'],
            'shipping_detail.*.contact_phone' => ['present', 'required', 'string'],
            'shipping_detail.*.contact_email' => ['present', 'required', 'email'],
            'shipping_detail.*.address_line_1' => ['present', 'required', 'string'],
            'shipping_detail.*.address_line_2' => ['present'],
            'shipping_detail.*.address_line_3' => ['present'],
            'shipping_detail.*.town' => ['present'],
            'shipping_detail.*.city' => ['present', 'required', 'string'],
            'shipping_detail.*.postcode' => ['present', 'required', 'string'],
            'shipping_detail.*.country' => ['present', 'required', 'string'],
            'shipping_detail.*.is_billing_details_same' => ['present', 'required', 'boolean'],
            'billing_detail' => ['required_if:shipping_detail.*.is_billing_details_same,0','present', 'required', 'array'],
            'billing_detail.*.contact_name' => ['sometime', 'string'],
            'billing_detail.*.contact_phone' => ['sometime', 'string'],
            'billing_detail.*.contact_email' => ['sometime', 'email'],
            'billing_detail.*.address_line_1' => ['sometime', 'string'],
            'billing_detail.*.address_line_2' => ['sometime'],
            'billing_detail.*.address_line_3' => ['sometime'],
            'billing_detail.*.town' => ['sometime'],
            'billing_detail.*.city' => ['sometime', 'string'],
            'billing_detail.*.postcode' => ['sometime', 'string'],
            'billing_detail.*.country' => ['sometime', 'string']
        ];
    }
}
