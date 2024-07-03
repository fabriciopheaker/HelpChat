<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChannelRequest extends FormRequest
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
            'NOME' => 'required|string|max:100',
            'ID_GUILD' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'NOME.required' => 'O campo nome é obrigatório',
            'NOME.string' => 'Algum erro no campo nome',
            'NOME.max' => 'O campo nome ultrapassou o limite de 100 caracteres.',
            'ID_GUILD.required' => 'O Servidor não Identificado',
        ];
    }
}
