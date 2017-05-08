<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|string|between:10,255|unique:posts,title',
            'description' => 'string|max:255',
            'content' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo TÍTULO é obrigatório.',
            'title.between' => 'O tamanho do campo TÍTULO deve ser entre 10 e 255 caracteres.',
            'title.unique' => 'Já existe um ARTIGO com este nome.',

            'description.max' => 'O tamanho do campo DESCRIÇÃO deve ter no máximo 255 caracteres.',

            'content.required' => 'O campo CONTEÚDO é obrigatório.',
            'content.max' => 'O campo CONTEÚDO deve ter no máximno 255 caracteres.',
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
