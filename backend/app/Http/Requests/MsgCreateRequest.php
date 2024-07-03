<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MsgCreateRequest extends FormRequest
{
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
            'MSG' => 'required|string|max:255',
            'ID_GUILD' => 'required',
            'ID_CHANNEL' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'MSG.required' => 'O campo mensagem é obrigatório',
            'MSG.string' => 'Algum erro no campo mensagem',
            'MSG.max' => 'O campo mensagem ultrapassou o limite de 255 caracteres.',
            'ID_GUILD.required' => 'Servidor não Identificado',
            'ID_CHANNEL.required' => 'Canal não Identificado',
        ];
    }
}
