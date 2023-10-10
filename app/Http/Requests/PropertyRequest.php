<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyRequest extends FormRequest
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
            'name' => 'required',
            'name_en' => 'required',
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
            'name'=> 'Название',
            'name_en'=> 'Название en'
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
            'required' => 'Поле :attribute обязательно для ввода'
        ];
    }
}
