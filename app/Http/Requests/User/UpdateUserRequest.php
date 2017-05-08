<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|string|between:4,255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo NOME é obrigatório.',
            'name.between' => 'o tamanho do campo NOME deve ser entre 4 e 255 caracteres.'
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
