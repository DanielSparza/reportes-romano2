<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
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
            //
            'clave_cliente' => ['required', 'numeric', 'integer', 'exists:clientes,fk_clave_persona', 'unique:App\Models\User,fk_clave_persona'],
            'nombre' => [
                'required', 'max:100',
                Rule::exists('personas', 'nombre')
                    ->where('clave_persona', 'clave_cliente'),
            ],
            'usuario' => ['required', 'min:5', 'max:20', 'unique:App\Models\User,usuario,'],
            'email' => ['required', 'email:rfc,dns', 'unique:App\Models\User,email,'],
            'password' => ['required', 'min:8', 'max:100', 'confirmed']
        ];
    }
}
