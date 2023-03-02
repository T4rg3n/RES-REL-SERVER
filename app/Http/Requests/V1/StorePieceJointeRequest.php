<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StorePieceJointeRequest extends FormRequest
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
            'type' => ['required', 'string', 'max:255'],
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'contenu' => ['nullable', 'string', 'max:255'],
            'dateActivite' => ['nullable', 'string', 'max:255'],
            'lieu' => ['nullable', 'string', 'max:255'],
            'codePostal' => ['nullable', 'string', 'max:255'],
            'idUtilisateur' => ['required', 'integer'],
            'file' => ['nullable', 'file', 'mimes:png,jpg,jpeg,gif,mp4,webm,pdf', 'max:15000'],
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
            'type_pj.required' => 'Type is required',
            'type_pj.string' => 'Type must be a string',
            'type_pj.max' => 'Type must be less than 255 characters',
            'titre_pj.required' => 'Titre is required',
            'titre_pj.string' => 'Titre must be a string',
            'titre_pj.max' => 'Titre must be less than 255 characters',
            'description_pj.required' => 'Description is required',
            'description_pj.string' => 'Description must be a string',
            'description_pj.max' => 'Description must be less than 255 characters',
            'contenu_pj.string' => 'Contenu must be a string',
            'contenu_pj.max' => 'Contenu must be less than 255 characters',
            'date_activite_pj.string' => 'DateActivite must be a string',
            'date_activite_pj.max' => 'DateActivite must be less than 255 characters',
            'lieu_pj.string' => 'Lieu must be a string',
            'lieu_pj.max' => 'Lieu must be less than 255 characters',
            'code_postal_pj.string' => 'CodePostal must be a string',
            'code_postal_pj.max' => 'CodePostal must be less than 255 characters',
            'fk_id_uti.required' => 'IdUtilisateur is required',
            'fk_id_uti.string' => 'IdUtilisateur must be a string',
            'fk_id_uti.max' => 'IdUtilisateur must be less than 255 characters',
            'pieceJointe.file' => 'PieceJointe must be a file',
            'pieceJointe.mimes' => 'PieceJointe must be a file of type: png, jpg, jpeg, gif, mp4, webm, pdf',
        ];
    }

    /**
     * Translate request parameters to database columns 
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'type_pj' => $this->type,
            'titre_pj' => $this->titre,
            'description_pj' => $this->description,
            'contenu_pj' => $this->contenu,
            'date_activite_pj' => $this->dateActivite,
            'lieu_pj' => $this->lieu,
            'code_postal_pj' => $this->codePostal,
            'fk_id_uti' => $this->idUtilisateur,
        ]);
    }
}
