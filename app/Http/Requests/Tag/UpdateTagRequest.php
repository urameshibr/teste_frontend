<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'name' => 'required|string|between:3,255|unique:tags,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo NOME DA TAG é obrigatório.',
            'name.between' => 'O campo NOME DA TAG deve ter entre 3 e 255 caracteres.',
            'name.unique' => 'Este nome de tag já está sendo usado.',
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
