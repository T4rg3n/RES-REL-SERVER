<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavorisRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Only for development
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'idUtilisateur' => ['required', 'integer'],
            'idRessource' => ['required', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'idUtilisateur.required' => 'idUtilisateur is required',
            'idUtilisateur.integer' => 'idUtilisateur must be an integer',
            'idRessource.required' => 'idRessource is required',
            'idRessource.integer' => 'idRessource must be an integer',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'fk_id_uti' => $this->idUtilisateur,
            'fk_id_ressource' => $this->idRessource,
        ]);
    }
}
