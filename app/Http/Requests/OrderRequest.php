<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'orders' => ['required', 'array'],
            'order.*.product_id' => ['required', 'exists:products,id'],
            'order.*.price' => ['required', 'integer', 'min:0'],
            'order.*.quantity' => ['required', 'integer', 'min:0'],
        ];
    }
}
