<?php

namespace App\Http\Requests\V1;

use App\Models\Bookmark;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreBookmarkRequest extends FormRequest
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
            'idUtilisateur' => ['required', function ($attribute, $value, $fail) {
                if ($this->idRessource) {
                    $exists = Bookmark::where('fk_id_uti', $value)
                                      ->where('fk_id_ressource', $this->idRessource)
                                      ->exists();
    
                    if ($exists) {
                        $fail('You can\'t add this resource to your bookmarks because it\'s already in it.');
                    }
                }
            }],
            'idRessource' => ['required', 'integer'],
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
            'idUtilisateur.required' => 'idUtilisateur is required',
            'idUtilisateur.integer' => 'idUtilisateur must be an integer',
            'idRessource.required' => 'idRessource is required',
            'idRessource.integer' => 'idRessource must be an integer',
        ];
    }

    /**
     * Translate request parameters to database columns
     * for the columns that need to be translated.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'fk_id_uti' => $this->idUtilisateur,
            'fk_id_ressource' => $this->idRessource,
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
