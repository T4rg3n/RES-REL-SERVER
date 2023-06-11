<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class SearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Everyone can search
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
            'query' => 'required|array',
            'query.ressource' => 'sometimes|array',
            'query.ressource.q' => 'sometimes|string',
            'query.ressource.include' => 'sometimes|array',
            'query.utilisateur' => 'sometimes|array',
            'query.utilisateur.q' => 'sometimes|string',
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

    public function formatted()
    {
        $data = $this->validated();

        $ressourceQuery = $data['query']['ressource']['q'] ?? null;
        $ressourceInclude = $data['query']['ressource']['include'] ?? [];
        $utilisateurQuery = $data['query']['utilisateur']['q'] ?? null;

        return [
            'ressourceQuery' => $ressourceQuery,
            'ressourceInclude' => $ressourceInclude,
            'utilisateurQuery' => $utilisateurQuery,
        ];
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
            'errors' => $validator->errors()
        ], 422));
    }
}
