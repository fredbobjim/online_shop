<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8'
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
            'name' => 'Имя',
            'email' => 'E-Mail',
            'password' => 'Пароль'
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
            'email' => 'Не верный формат поля E-mail',
            'confirmed' => 'Подтверждение пароля не совпадает',
            'min' => 'Поле :attribute должно содержать минимум :min символов',
            'max' => 'Поле :attribute должно содержать не более :max символов',
            'unique' => 'Пользователь с таким Email уже зарегистрирован'
        ];
    }
}
