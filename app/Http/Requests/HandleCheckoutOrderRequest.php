<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HandleCheckoutOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'contact_name' => 'required|min:2|max:255',
            'contact_phone' => 'required|min:11|max:15|regex:/^\+\d+$/',
            'comment' => 'nullable|string|max:255',
            'address' => 'required|string|max:255|regex:/^[a-zA-Zа-яА-ЯёЁ]+\s+\d+[\s\p{L}\d\.,-]*$/u'
        ];
    }
    public function messages()
    {
        return [
            'contact_name.required' => 'введите имя',
            'contact_name.min' => 'имя пользователя должно быть больше 2 символов',
            'contact_phone.required' => 'введите номер телефона',
            'contact_phone.min' => 'номер телефона не может быть меньше 11 символов',
            'contact_phone.max' => 'номер телефона не может быть больше 12 символов',
            'contact_phone.regex' => 'номер телефона должен начинаться с + и содержать только цифры',
            'address.required' => 'введите адрес',
            'address.regex' => 'адрес должен содержать название улицы и номер дома'
        ];
    }
}
