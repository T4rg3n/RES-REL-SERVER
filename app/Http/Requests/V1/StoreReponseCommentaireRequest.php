<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreReponseCommentaireRequest extends FormRequest
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
            'contenu' => ['required', 'string'],
            'idCommentaire' => ['required', 'integer'],
            'idUtilisateur' => ['required', 'integer'],
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
            'contenu.required' => 'contenu is required',
            'contenu.string' => 'contenu must be a string',
            'idCommentaire.required' => 'idCommentaire is required',
            'idCommentaire.integer' => 'idCommentaire must be an integer',
            'idUtilisateur.required' => 'idUtilisateur is required',
            'idUtilisateur.integer' => 'idUtilisateur must be an integer',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'contenu_reponse' => $this->contenu,
            'fk_id_commentaire' => $this->idCommentaire,
            'fk_id_uti' => $this->idUtilisateur,
        ]);
    }
}
