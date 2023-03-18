<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //only for development
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
            'ressourceQuery' => ['string', 'max:255'],
            'utilisateurQuery' => ['string', 'max:255']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages()
    {
        return [
            'ressourceQuery.string' => 'Ressource query must be a string',
            'ressourceQuery.max' => 'Ressource query must be less than 255 characters',
            'utilisateurQuery.string' => 'Utilisateur query must be a string',
            'utilisateurQuery.max' => 'Ressource query must be less than 255 characters',
        ];
    }
}
