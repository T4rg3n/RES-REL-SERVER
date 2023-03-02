<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentaireRequest extends FormRequest
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
            'contenu' => ['required', 'string', 'max:255'],
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
            'contenu.required' => 'Contenu is required',
            'contenu.string' => 'Contenu must be a string',
            'contenu.max' => 'Contenu must be less than 255 characters',
            'idUtilisateur.required' => 'IdUtilisateur is required',
            'idUtilisateur.integer' => 'IdUtilisateur must be an integer',
            'idRessource.required' => 'IdRessource is required',
            'idRessource.integer' => 'IdRessource must be an integer',
        ];
    }

    /**
     * Translate request parameters to database columns 
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'contenu_commentaire' => $this->contenu,
            'fk_id_uti' => $this->idUtilisateur,
            'fk_id_ressource' => $this->idRessource,
        ]);
    }
}
