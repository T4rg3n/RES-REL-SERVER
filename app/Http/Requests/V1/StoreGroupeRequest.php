<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupeRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'estPrive' => ['required', 'boolean'],
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
            'nom.required' => 'Groupe name is required',
            'nom.string' => 'Groupe name must be a string',
            'nom.max' => 'Groupe name must be less than 255 characters',
            'description.required' => 'Groupe description is required',
            'description.string' => 'Groupe description must be a string',
            'description.max' => 'Groupe description must be less than 255 characters',
            'estPrive.boolean' => 'Groupe privacy must be a boolean',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'nom_groupe' => $this->nom,
            'description_groupe' => $this->description,
            'est_prive_groupe' => $this->estPrive,
        ]);
    }
}
