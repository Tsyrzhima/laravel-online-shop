<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_id' => 'integer|exists:products,id',
            'amount' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'product_id.integer' => 'id продукта может содержать только цифры',
            'product_id.exists' => 'продукта c таким id не существует',
            'amount.required' => 'введите количество',
            'amount.integer' => 'количество продукта может содержать только цифры'
        ];
    }

}
