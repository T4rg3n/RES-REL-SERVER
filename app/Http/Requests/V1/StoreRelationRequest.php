<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreRelationRequest extends FormRequest
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
            'idDemandeur' => ['required', 'integer'],
            'idReceveur' => ['required', 'integer'],
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
            'idDemandeur.required' => 'idDemandeur is required',
            'idDemandeur.integer' => 'idDemandeur must be an integer',
            'idReceveur.required' => 'idReceveur is required',
            'idReceveur.integer' => 'idReceveur must be an integer',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'demandeur_id' => $this->idDemandeur,
            'receveur_id' => $this->idReceveur,
        ]);
    }
}
