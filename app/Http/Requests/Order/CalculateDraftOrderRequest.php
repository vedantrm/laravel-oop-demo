<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ApiResponses;

class CalculateDraftOrderRequest extends FormRequest
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
            'order_line_items' => ['present', 'required', 'array'],
            'order_line_items.*.quantity' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.price' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.discount' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.total' => ['present', 'required', 'numeric','gt:0']
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
