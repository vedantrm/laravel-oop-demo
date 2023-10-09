<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ShippingBillingType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Request to create an order shipping and billing detail
 */
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
            'contact_name' => ['present', 'required', 'string'],
            'contact_phone' => ['present', 'required', 'string'],
            'contact_alt_no' => ['sometimes', 'required', 'string'],
            'contact_email' => ['present', 'required', 'email'],
            'type' => ['present', 'required', new Enum(ShippingBillingType::class)],
            'address_line_1' => ['present','required', 'string'],
            'address_line_2' => ['sometimes', 'required', 'string'],
            'address_line_3' => ['sometimes', 'required', 'string'],
            'town' => ['present', 'required', 'string'],
            'city' => ['present', 'required', 'string'],
            'postcode' => ['present', 'required', 'string'],
            'country' => ['present', 'required', 'string'],
            'is_billing_details_same' => ['present', 'required', 'boolean']
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

        $response = response()->json([
            'success' => false,
            'message' => 'Ops! Some errors occurred',
            'errors' => $validator->errors()
        ]);            
        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag);
    }
}
