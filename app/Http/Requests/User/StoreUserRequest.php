<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|between:4,255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|between:6,10|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório.',
            'name.between' => 'o tamanho do campo NOME deve ser entre 4 e 255 caracteres.',

            'email.required' => 'O campo EMAIL é obrigatório.',
            'email.max' => 'O campo EMAIL deve ter no máximo 255 caracteres.',
            'email.email' => 'O campo EMAIL deve conter um email válido.',
            'email.unique' => 'Este email já está sendo usado.',

            'password.required' => 'O campo SENHA é obrigatório.',
            'password.between' => 'O tamanho do campo SENHA deve ser entre 6 e 10 caracteres.',
            'password.confirmed' => 'A CONFIRMAÇÃO DE SENHA não corresponde a senha digitada.'
        ];
    }

    public function response(array $errors)
    {
        return response()->json([
            'status' => false,
            'code' => 422,
            'validation_errors' => $errors
        ],422);
    }
}
