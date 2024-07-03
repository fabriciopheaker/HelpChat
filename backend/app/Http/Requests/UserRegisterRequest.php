<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'NOME' => 'required|string|max:255,',
            'EMAIL' => 'required|email|max:255,',
            'PASSWORD' => 'required|string|max:255,',
        ];
    }
    public function messages()
    {
        return [
            'NOME.required' => 'O campo nome é obrigatório',
            'NOME.string' => 'Algum erro no campo nome',
            'NOME.max' => 'O campo nome ultrapassou o limite de 255 caracteres.',

            'EMAIL.required' => 'O campo email é obrigatório.',
            'EMAIL.email' => 'O campo email está incorreto.',
            'EMAIL.max' => 'O campo email ultrapassou o limite de 255 caracteres.',

            'PASSWORD.required' => 'O campo senha é obrigatório.',
            'PASSWORD.string' => 'Algum erro no campo senha',
            'PASSWORD.max' => 'O campo senha ultrapassou o limite de 255 caracteres.',
        ];
    }
}
