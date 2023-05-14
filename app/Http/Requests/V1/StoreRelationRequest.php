<?php

namespace App\Http\Requests\V1;

use App\Models\Relation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
            'idDemandeur' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($this->idReceveur) {
                    $exists = Relation::where('demandeur_id', $value)
                                      ->where('receveur_id', $this->idReceveur)
                                      ->exists();
    
                    if ($exists) {
                        $fail('This friend request already exists.');
                    }
                }
            }],
            'idReceveur' => ['required', 'integer'],
            'typeRelation' => ['required', 'integer'],
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
            'typeRelation.required' => 'typeRelation is required',
            'typeRelation.integer' => 'typeRelation must be an integer',
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
            'fk_id_type_relation' => $this->typeRelation,
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
