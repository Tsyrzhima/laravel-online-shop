<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrateRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Введите имя',
            'name.min' => 'Имя пользователя должно быть больше 2 символов',
            'name.max' => 'Имя пользователя не может быть больше 255 символов',
            'email.required' => 'Введите email',
            'email.email' => 'Некоректный email',
            'email.max' => 'Email не может быть больше 255 символов',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.required' => 'Введите пароль',
            'password.min' => 'Введите пароль больше 8 символов',
            'password.max' => 'Пароль не может быть больше 255 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
