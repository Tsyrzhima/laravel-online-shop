<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|between:1,5',
            'comment' => 'string',
        ];
    }
    public function messages()
    {
        return [
            'grade.required' => 'выберите оценку',
            'grade.between' => 'оценка может быть только от 1 до 5',
        ];
    }

}
