<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'count' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:1',

        ];
    }

    /**
     * Get attributes names for error messages
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'count' => 'Количество на складе',
            'price'=> 'Цена',
        ];
    }

    /**
     * Get error messages for certain validation rules
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно содержать минимум :min символа',
            'numeric' => 'Поле :attribute должно содержать только цифры'
        ];
    }
}
