<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class RefuseRessourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //For dev only
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
            //'exists:ressources,id_ressource'
            'id' => ['required', 'integer'],
            'raison' => ['required', 'string', 'max:255'],
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
            'id.required' => 'id is required',
            'id.integer' => 'id must be an integer',
            'id.exists' => 'id must exist in the database',
            'raison.required' => 'raison is required',
            'raison.string' => 'raison must be a string',
            'raison.max' => 'raison must not be greater than 255 characters',
        ];
    }

    /**
     * Translate request parameters to database
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id_ressource' => $this->id,
            'raison_refus_ressource' => $this->raison,
        ]);
    }
}
