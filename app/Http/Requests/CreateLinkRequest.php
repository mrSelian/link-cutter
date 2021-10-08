<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
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
            'targetLink' => ['required', 'url'],
            'alias' => ['nullable', 'regex:/^[a-zA-Z0-9-_]{4,}$/', 'unique:App\Models\Link,alias']
        ];
    }

    public function messages()
    {
        return [
            'targetLink.required' => 'Вы не указали ссылку!',
            'targetLink.url' => 'Ссылка имеет неверный формат!',
            'alias.regex' => 'Алиас может содержать только символы латинского алфавита и цифры, а также знаки  - и  _',
            'alias.unique' => 'Выбранный алиас уже занят!',
        ];
    }
}
