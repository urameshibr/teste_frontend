<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class DeleteTagRequest extends FormRequest
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
            'confirmation' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
            'confirmation.required' => 'É preciso confirmar esta operação para excluir um registro.',
            'confirmation.boolean' => 'O valor da confirmação deve ser true ou false',
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
