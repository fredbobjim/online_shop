<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'code' => 'required|min:3|max:255|unique:categories,code',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
        ];
        if ($this->route()->named('categories.update')){
            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
        }

        return $rules;
    }

    /**
     * Get attributes names for error messages
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'code' => 'Код',
            'name'=> 'Название',
            'description'=> 'Описание'
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
            'max' => 'Поле :attribute должно содержать не более :max символов',
            'unique' => 'Категория с таким кодом уже существует'
        ];
    }
}
