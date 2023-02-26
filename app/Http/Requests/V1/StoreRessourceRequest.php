<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreRessourceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titreRessource' => ['required'],
            'contenu' => ['required'],
            'idUtilisateur' => ['required'],
            'idCategorie' => ['required'],
        ];
    }
    
    /**
     * Translate request parameters to database columns
     * (for the columns that need to be translated)
     */
    protected function preprareForValidation()
    {
        $this->merge([
            'titre_ressource' => $this->titreRessource,
            'fk_id_uti' => $this->idUtilisateur,
            'fk_id_categorie' => $this->idCategorie,
        ]);
    }
}
