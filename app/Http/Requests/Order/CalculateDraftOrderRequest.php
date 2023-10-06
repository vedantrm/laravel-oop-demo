<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CalculateDraftOrderRequest extends FormRequest
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
            'order_line_items' => ['present', 'required', 'array'],
            'order_line_items.*.quantity' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.price' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.discount' => ['present', 'required', 'numeric','gt:0'],
            'order_line_items.*.total' => ['present', 'required', 'numeric','gt:0']
        ];
    }
}
