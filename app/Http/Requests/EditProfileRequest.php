<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
            'name' => 'sometimes|nullable|min:2|max:255',
            'email' => [
                'sometimes',
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'password' => 'sometimes|nullable|min:8|max:255|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'name.min' => 'Имя пользователя должно быть больше 2 символов',
            'name.max' => 'Имя пользователя не может быть больше 255 символов',
            'email.email' => 'Некоректный email',
            'email.max' => 'Email не может быть больше 255 символов',
            'email.unique' => 'Пользователь с таким email уже существует',
            'password.min' => 'Введите пароль больше 8 символов',
            'password.max' => 'Пароль не может быть больше 255 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
