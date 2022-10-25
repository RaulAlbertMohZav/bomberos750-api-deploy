<?php

namespace App\Http\Requests\JsonApiAuth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            config('json-api-auth.access_key', 'access_key') => 'required|string|min:8|max:10',
            'password' => 'required|string|max:100',
        ];
    }

    public function attributes()
    {
        return [
            config('json-api-auth.access_key', 'access_key') => 'DNI',
            'password' => 'Contraseña'
        ];
    }
}
