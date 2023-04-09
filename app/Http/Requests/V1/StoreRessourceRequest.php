<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use \Illuminate\Validation\ValidationException;

class StoreRessourceRequest extends FormRequest
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
            'titre' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string', 'max:65535'],
            'idUtilisateur' => ['required', 'integer'],
            'idCategorie' => ['required', 'integer'],
            'idPieceJointe' => ['nullable', 'integer'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'titre.required' => 'Titre is required',
            'titre.string' => 'Titre must be a string',
            'titre.max' => 'Titre must be less than 255 characters',
            'contenu.required' => 'Contenu is required',
            'contenu.string' => 'Contenu must be a string',
            'contenu.max' => 'Contenu must be less than 65535 characters',
            'idUtilisateur.required' => 'IdUtilisateur is required',
            'idUtilisateur.integer' => 'IdUtilisateur must be an integer',
            'idCategorie.required' => 'IdCategorie is required',
            'idCategorie.integer' => 'IdCategorie must be an integer',
            'idPieceJointe.integer' => 'IdPieceJointe must be an integer',
        ];
    }
    
    /**
     * Translate request parameters to database columns 
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'titre_ressource' => $this->titre,
            'contenu_texte_ressource' => $this->contenu,
            'fk_id_uti' => $this->idUtilisateur,
            'fk_id_categorie' => $this->idCategorie,
            'fk_id_piece_jointe' => $this->idPieceJointe,
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
